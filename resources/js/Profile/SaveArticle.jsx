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
                                    <img
                                        src={d.article.image_url}
                                        className="w-100 rounded col-4"
                                        alt="Article Image"
                                    />
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
