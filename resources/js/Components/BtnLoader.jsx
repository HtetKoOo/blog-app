import React from "react";
import { BeatLoader } from "react-spinners";

const BtnLoader = () => {
    return (
        <BeatLoader
            color={"#FA441B"}
            loading={true}
            size={10}
            cssOverride={{marginLeft: "10px"}}
            aria-label="Loading Spinner"
            data-testid="loader"
        />
    );
}

export default BtnLoader;