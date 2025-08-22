import React, {useEffect} from 'react';
import Title from "../components/Title";
import axiosInstance from "../communication/axiosInstance";
import {Col, Row} from "react-bootstrap";
import {Chart} from "react-google-charts";

const Administration = () => {

    const [graphData, setGraphData] = React.useState([]);

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
            </Row>

        </div>
    );
};

export default Administration;
