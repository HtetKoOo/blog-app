import React, { useState } from "react";
import { createRoot } from "react-dom/client";
import BtnLoader from "./Components/BtnLoader";
import axios from "axios";
const article_detail = bladeArticleDetail;
const isAuth = bladeIsAuth;

const App = () => {
    const [comments, setComments] = useState(article_detail.comment);
    const [comment, setComment] = useState("");
    const [commentLoader, setCommentLoader] = useState(false);
    const [likeCount, setLikeCount] = useState(article_detail.like_count);    
    
    const addComment = () => {
        setCommentLoader(true);
        axios
            .post("/api/article-comment", {
                comment,
                article_id: article_detail.id,
            })
            .then((d) => {
                setComments([d.data, ...comments]);
                setComment("");
                setCommentLoader(false);
                showSuccess("Comment added successfully");
            });
    };
    const articleLike = () => {
        axios.post("/api/article-like", { id: article_detail.id }).then((d) => {
            if (d.data == "already_liked") {
                showError("You have already liked this article");
                return;
            }
            if (d.data == "success") {
                setLikeCount(likeCount + 1);
                showSuccess("Liked successfully");
            }
        });
    };
    const saveArticle = () => {
        axios.post("/api/article-save", { id: article_detail.id }).then((d) => {
            if (d.data == "already_saved") {
                showError("Article already saved");
                return;
            }
            if (d.data == "success") {
                showSuccess("Article saved successfully");
            }
        });
    };
    return (
        <>
            <div>
                <img
                    src={article_detail.image_url}
                    className="w-100 rounded"
                    alt="Article Image"
                />
                <div>
                    <h3 className="text-white">{article_detail.title}</h3>
                </div>
                <div className="mt-2">
                    {article_detail.tag.map((tag) => (
                        <span
                            key={tag.id}
                            className="btn btn-sm btn-dark text-white mr-2"
                        >
                            {tag.name}
                        </span>
                    ))}
                    {article_detail.programming.map((prog) => (
                        <span
                            key={prog.id}
                            className="btn btn-sm btn-primary text-white mr-2"
                        >
                            {prog.name}
                        </span>
                    ))}
                    |
                    <button
                        onClick={articleLike}
                        className="btn btn-sm btn-danger"
                    >
                        Like : {likeCount}
                    </button>
                    <button
                        onClick={saveArticle}
                        className="btn btn-sm btn-warning"
                    >
                        Save
                    </button>
                </div>
                <div
                    className="card card-body bg-card mt-2"
                    dangerouslySetInnerHTML={{
                        __html: article_detail.description,
                    }}
                ></div>
                <div className="card card-body bg-card mt-2">
                    <h4 className="text-white">Comment List</h4>
                    {isAuth && (
                        <>
                            <textarea
                                onChange={(e) => setComment(e.target.value)}
                                className="form-control"
                                value={comment}
                            />
                            <div className="mt-1">
                                <button
                                    disabled={commentLoader}
                                    onClick={addComment}
                                    className="btn btn-primary"
                                >
                                    Comment
                                    {commentLoader && <BtnLoader />}
                                </button>
                            </div>
                        </>
                    )}
                    {!isAuth && (
                        <div className="alert alert-warning mt-2">
                            Please login to comment.
                        </div>
                    )}
                </div>
                {comments.map((comment) => (
                    <div
                        key={comment.id}
                        className="card card-body bg-card mt-2"
                    >
                        <div>
                            <b className="text-white">{comment.author_name}</b>
                            <small className="text-muted ml-2">
                                {comment.time_ago}
                            </small>
                        </div>
                        <p className="mt-2 mb-0">{comment.comment}</p>
                    </div>
                ))}
            </div>
        </>
    );
};

createRoot(document.getElementById("root")).render(<App />);
