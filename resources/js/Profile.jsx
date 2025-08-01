import React from "react";
import { createRoot } from "react-dom/client";
import { HashRouter, Routes, Route, Link } from "react-router-dom";
import SaveArticle from "./Profile/SaveArticle";
import Setting from "./Profile/Setting";

const App = () => {
    return (
        <HashRouter>
            <div className="my-3">
                <Link to={'/'} className="btn btn-primary">Saved Article</Link>
                <Link to={'/setting'} className="btn btn-primary">Account Setting</Link>
            </div>
            <Routes>
                <Route path="/" element={<SaveArticle />} />
                <Route path="/setting" element={<Setting />} />
            </Routes>
        </HashRouter>
    );
};

createRoot(document.getElementById("root")).render(<App />);
