import React from 'react';
import PropTypes from 'prop-types';
import {IoIosCall, IoIosMail, IoMdMap} from "react-icons/io";

const ContactDetails = props => {

    const {email, phone, address, city} = props;

    return (
        <>
            <ul className="contact-details">
                <li>
                    <IoIosMail /> {email}
                </li>
                <li>
                    <IoIosCall /> {phone}
                </li>
                <li>
                    <IoMdMap /> {address}, {city}
                </li>
            </ul>
        </>
    );
};

ContactDetails.propTypes = {
    email : PropTypes.string.isRequired,
    phone : PropTypes.string.isRequired,
    address : PropTypes.string.isRequired,
    city : PropTypes.string.isRequired,
};

export default ContactDetails;
