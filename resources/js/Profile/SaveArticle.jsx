import React from "react";
import { useState, useEffect } from "react";
import axios from "axios";
import Loader from "../Components/Loader";
const SaveArticle = () => {
    const [article, setArticle] = useState([]);
    const [loader, setLoader] = useState(true);
    useEffect(() => {
        axios.get("/api/article-save").then((d) => {
            setArticle(d.data);
            setLoader(false);
        });
    }, []);
    return (
        <div className="card card-body bg-card mb-0">
            {loader && <Loader />}
            {!loader &&
                (article.length > 0 ? (
                    article.map((d, index) => {
                        if (!d.article) return null;

                        return (
                            <div className="mb-3" key={d.id || index}>
                                <a
                                    href={`/article/${d.article.id}`}
                                    className="border p-3 row rounded"
                                >
                                    <div
                                        className="col-3"
                                        style={{
                                            position: "relative",
                                            width: "100%",
                                            height: "150px",
                                            borderRadius: "15px",
                                            overflow: "hidden",
                                            display: "flex",
                                            alignItems: "center",
                                            justifyContent: "center",
                                        }}
                                    >
                                        <div
                                            style={{
                                                backgroundImage: `url(${d.article.image_url})`,
                                                backgroundPosition: "center",
                                                backgroundSize: "cover",
                                                filter: "blur(20px)",
                                                position: "absolute",
                                                top: 0,
                                                left: 0,
                                                right: 0,
                                                bottom: 0,
                                                zIndex: 0,
                                            }}
                                        ></div>
                                        <img
                                            src={d.article.image_url}
                                            alt="Article Image"
                                            style={{
                                                maxWidth: "100%",
                                                maxHeight: "100%",
                                                objectFit: "contain",
                                                objectPosition: "center",
                                                position: "relative",
                                                zIndex: 1,
                                                display: "block",
                                            }}
                                        />
                                    </div>
                                    <div className="ml-3">
                                        <h5 className="text-white">
                                            {d.article.title}
                                        </h5>
                                        <p className="text-muted">
                                            {d.article.description}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        );
                    })
                ) : (
                    <p>No saved articles found.</p>
                ))}
        </div>
    );
};
export default SaveArticle;
