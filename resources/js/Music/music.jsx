import React, { useState, useRef, useEffect } from "react";
import { createRoot } from "react-dom/client";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
    faMusic,
    faCompactDisc,
    faPerson,
    faGenderless,
    faPodcast,
    faHeart,
    faClone,
    faGear,
    faUpload,
    faUser,
    faShuffle,
    faFilter,
    faPlay,
    faPause,
    faForward,
    faBackward,
    faVolumeUp,
} from "@fortawesome/free-solid-svg-icons";

const App = () => {
    const songs = bladeMusic;
    const [currentIndex, setCurrentIndex] = useState(null);
    const [isPlaying, setIsPlaying] = useState(false);
    const [progress, setProgress] = useState(0);
    const [duration, setDuration] = useState(0);
    const [volume, setVolume] = React.useState(0.5);
    const audioRef = React.useRef(null);

    // Handle play/pause
    const handlePlayPause = () => {
        if (!audioRef.current) return;
        if (isPlaying) {
            audioRef.current.pause();
        } else {
            audioRef.current.play();
        }
        setIsPlaying(!isPlaying);
    };

    // Next / Previous
    const handleNext = () => {
        if (currentIndex === null) return;
        const nextIndex = (currentIndex + 1) % songs.length;
        setCurrentIndex(nextIndex);
    };

    const handlePrev = () => {
        if (currentIndex === null) return;
        const prevIndex = (currentIndex - 1 + songs.length) % songs.length;
        setCurrentIndex(prevIndex);
    };

    // Update progress
    const handleTimeUpdate = () => {
        if (!audioRef.current) return;
        setProgress(audioRef.current.currentTime);
    };

    const handleLoadedMetadata = () => {
        if (audioRef.current) {
            setDuration(audioRef.current.duration);
        }
    };

    // Seek
    const handleSeek = (e) => {
        const newTime = e.target.value;
        audioRef.current.currentTime = newTime;
        setProgress(newTime);
    };

    // Volume
    const handleVolume = (e) => {
        const newVol = e.target.value;
        if (audioRef.current) {
            audioRef.current.volume = newVol;
        }
        setVolume(newVol);
    };

    // Auto play when song changes
    React.useEffect(() => {
        if (currentIndex !== null && audioRef.current) {
            audioRef.current.volume = 0.5;
            audioRef.current.play();
            setIsPlaying(true);
        }
    }, [currentIndex]);

    const formatTime = (time) => {
        if (isNaN(time)) return "0:00";
        const minutes = Math.floor(time / 60);
        const seconds = Math.floor(time % 60)
            .toString()
            .padStart(2, "0");
        return `${minutes}:${seconds}`;
    };

    return (
        <>
            <div className="row">
                {/* Sidebar */}
                <div className="col-3">
                    <div className="bg-card p-3 rounded">
                        <ul className="list-unstyled" id="music_side_list">
                            <li className="list_title">Your Library</li>
                            <li>
                                <a href="#">
                                    <FontAwesomeIcon icon={faMusic} /> All Songs
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <FontAwesomeIcon icon={faCompactDisc} />{" "}
                                    Albums
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <FontAwesomeIcon icon={faPerson} /> Singers
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <FontAwesomeIcon icon={faGenderless} />{" "}
                                    Genres
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <FontAwesomeIcon icon={faPodcast} />{" "}
                                    Podcasts
                                </a>
                            </li>

                            <br />

                            <li className="list_title">PLAYLISTS</li>
                            <li>
                                <a href="#">
                                    <FontAwesomeIcon icon={faHeart} /> Favorites
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <FontAwesomeIcon icon={faClone} /> Recently
                                    Played
                                </a>
                            </li>

                            <br />

                            <li className="list_title">MANAGEMENT</li>
                            <li>
                                <a href="#">
                                    <FontAwesomeIcon icon={faGear} /> Settings
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <FontAwesomeIcon icon={faUpload} /> Upload
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <FontAwesomeIcon icon={faUser} /> Users
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                {/* Main Content */}
                <div className="col-9">
                    <div className="row mb-3">
                        <div>
                            <img src="" alt="Recently Played" />
                        </div>
                        <div className="col">
                            <h2>Recently Played</h2>
                            <div className="d-flex">
                                <button className="btn btn-dark d-inline-flex align-items-center me-2">
                                    <FontAwesomeIcon
                                        icon={faShuffle}
                                        className="me-2"
                                    />
                                    <span>ALL</span>
                                </button>
                                <button className="btn btn-dark d-inline-flex align-items-center">
                                    <FontAwesomeIcon icon={faFilter} />
                                </button>
                            </div>
                        </div>
                    </div>

                    {/* Song List */}
                    <div className="card bg-dark text-white p-3 rounded">
                        {songs.map((d, index) => (
                            <a
                                className="mb-2"
                                key={d.id}
                                href=""
                                onClick={(e) => {
                                    e.preventDefault();
                                    setCurrentIndex(index);
                                }}
                            >
                                <div
                                    className="border p-1 row rounded align-items-center"
                                    style={{ height: "60px" }}
                                >
                                    <div className="col-1 d-flex">
                                        {index + 1}
                                    </div>
                                    <img
                                        src={d.thumbnail_url}
                                        className="img-fluid col-1"
                                        style={{
                                            maxHeight: "40px",
                                            objectFit: "cover",
                                        }}
                                        alt="Album Photo"
                                    />
                                    <div className="col-3 d-flex align-items-center">
                                        {d.title}
                                    </div>
                                    <div className="col-5 d-flex align-items-center">
                                        {d.singer.map((s) => s.name).join(", ")}
                                    </div>
                                    <div className="col-2 text-center">
                                        <button className="btn btn-dark">
                                            <i className="fa-solid fa-ellipsis"></i>
                                        </button>
                                    </div>
                                </div>
                            </a>
                        ))}
                    </div>
                </div>
            </div>
            {/* Player Bar */}
            {currentIndex !== null && (
                <div
                    className="bg-dark text-white p-2 d-flex align-items-center justify-content-between rounded"
                    style={{
                        position: "fixed",
                        bottom: 0,
                        left: 0,
                        right: 0,
                        height: "80px",
                    }}
                >
                    {/* Song info */}
                    <div className="d-flex align-items-center col-3">
                        <img
                            src={songs[currentIndex].thumbnail_url}
                            alt="album photo"
                            style={{
                                height: "60px",
                                width: "60px",
                                objectFit: "cover",
                            }}
                            className="rounded mr-3"
                        />
                        <div>
                            <div className="fw-bold">
                                {songs[currentIndex].title}
                            </div>
                            <div>
                                {songs[currentIndex].singer
                                    .map((s) => s.name)
                                    .join(", ")}
                            </div>
                        </div>
                    </div>

                    {/* Controls */}
                    <div className="col-6 d-flex flex-column align-items-center">
                        <div className="d-flex align-items-center mb-1">
                            <button
                                className="btn btn-light me-2"
                                onClick={handlePrev}
                            >
                                <FontAwesomeIcon icon={faBackward} />
                            </button>
                            <button
                                className="btn btn-light me-2"
                                onClick={handlePlayPause}
                            >
                                <FontAwesomeIcon
                                    icon={isPlaying ? faPause : faPlay}
                                />
                            </button>
                            <button
                                className="btn btn-light"
                                onClick={handleNext}
                            >
                                <FontAwesomeIcon icon={faForward} />
                            </button>
                        </div>

                        {/* Progress Bar */}
                        <div className="d-flex align-items-center mt-2">
                            <span className="me-2">{formatTime(progress)}</span>
                            <input
                                type="range"
                                min="0"
                                max={duration}
                                value={progress}
                                onChange={handleSeek}
                                style={{ width: "300px" }}
                            />
                            <span className="ms-2">{formatTime(duration)}</span>
                        </div>
                    </div>

                    {/* Volume */}
                    <div className="col-3 d-flex justify-content-end align-items-center">
                        <FontAwesomeIcon icon={faVolumeUp} className="me-2" />
                        <input
                            type="range"
                            min="0"
                            max="1"
                            step="0.01"
                            value={volume}
                            onChange={handleVolume}
                            style={{ width: "100px" }}
                        />
                    </div>
                </div>
            )}
            <audio
                ref={audioRef}
                src={currentIndex !== null ? songs[currentIndex].music_url : ""}
                onTimeUpdate={handleTimeUpdate}
                onLoadedMetadata={handleLoadedMetadata}
            />
        </>
    );
};

createRoot(document.getElementById("root")).render(<App />);
