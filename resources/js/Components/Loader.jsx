import React from "react";
import { BeatLoader } from "react-spinners";

const Loader = () => {
    return (
        <div className="d-flex justify-content-center align-items-center vh-100">
            <BeatLoader
                color={"#FA441B"}
                loading={true}
                size={30}
                aria-label="Loading Spinner"
                data-testid="loader"
            />
        </div>
    );
};

export default Loader;
