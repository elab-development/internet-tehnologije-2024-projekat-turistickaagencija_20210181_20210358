import React, {useEffect} from 'react';
import Title from "../components/Title";
import axiosInstance from "../communication/axiosInstance";
import {Col, Row, Table} from "react-bootstrap";
import {Chart} from "react-google-charts";
import {FaTrash} from "react-icons/fa";
import {toast} from "react-toastify";

const Administration = () => {

    const [graphData, setGraphData] = React.useState([]);

    const token = window.sessionStorage.getItem('token');
    const user = token ? JSON.parse(window.sessionStorage.getItem('user')) : null;

    const [link, setLink] = React.useState("http://127.0.0.1:8000/api/arrangements/filter");
    const [arrangements, setArrangements] = React.useState([]);
    const [buttons, setButtons] = React.useState([]);

    useEffect(() => {
        axiosInstance.get("http://127.0.0.1:8000/api/graphics").then(response => {
            let data = [['Price range', 'Number of arrangements']];
            let dataFromServer = response.data.data;
            for (let i = 0; i < dataFromServer.length; i++) {
                data.push([dataFromServer[i].price_range, dataFromServer[i].count]);
            }

            setGraphData(data);
        }).catch(error => {
            console.error("There was an error fetching the graph data!", error);
            setGraphData([]);
        })
    }, []);

    useEffect(() => {
        axiosInstance.get(link).then(response => {
            console.log(response);
            setArrangements(response.data.data);
            setButtons(response.data.links);
        })
    }, [link]);

    const deleteArrangement = (id) => {

        if (window.confirm("Are you sure you want to delete this arrangement?")) {
            axiosInstance.delete('/arrangement/' + id).then(response => {
                console.log(response);
                setArrangements(arrangements.filter(arrangement => arrangement.id !== id));
                toast.success("Arrangement deleted successfully!");
            }).catch(error => {
                toast.error("There was an error deleting the arrangement!", error);
            })
        }

    }

    return (
        <div>
            <Title title="Administration" subtitle="Panel"/>
            <Row>
                <Col md={12} className="mb-4">
                    <Chart chartType="ColumnChart" width="100%" height="100%" data={graphData} options={
                        {
                            title: 'Number of Arrangements by Price Range',
                            hAxis: { title: 'Price Range' },
                            vAxis: { title: 'Number of Arrangements' },
                            legend: 'none',
                        }
                    } />
                </Col>

                <Col md={12} className="mb-4">
                    {
                        arrangements.length > 0 ? (
                            <>
                                <Table hover responsive className="mb-4">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Arrangement</th>
                                            <th>Date</th>
                                            <th>Price (&euro;)</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {
                                            arrangements.map((arrangement, index) => (
                                                <tr key={index}>
                                                    <td>{index + 1}</td>
                                                    <td>{arrangement.name}</td>
                                                    <td>{new Date(arrangement.date).toLocaleDateString('en-GB')}</td>
                                                    <td>{arrangement.price} &euro;</td>
                                                    <td>
                                                        <button className="button-pink" onClick={() => {
                                                            deleteArrangement(arrangement.id)
                                                        }} disabled={user.role !== 'admin'}>
                                                            <FaTrash />
                                                        </button>
                                                    </td>
                                                </tr>
                                            ))
                                        }
                                    </tbody>
                                </Table>

                                {
                                    buttons.length > 0 && (
                                        <>
                                            {
                                                buttons.map((button, index) => (
                                                    <button key={index} className="button-pink m-1" onClick={() => {
                                                        setLink(button.url)}
                                                    } disabled={!button.url}>
                                                        {button.label.replace(/&laquo;|&raquo;/g, '')}
                                                    </button>
                                                ))
                                            }
                                        </>
                                    )
                                }
                            </>
                        ) : (
                            <>
                                No destinations to show.
                            </>
                        )
                    }
                </Col>
            </Row>

        </div>
    );
};

export default Administration;
