import React, { useState } from 'react';

const useFormData = (initialValues) => {
    const [formData, setFormData] = React.useState(initialValues);

    const handleInputChange = (event) => {
        const { name, value } = event.target;
        setFormData(prevState => ({
            ...prevState,
            [name]: value
        }));
    }

    return {
        formData,
        handleInputChange
    }
}

export default useFormData;
