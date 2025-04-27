<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background: #141414;
        overflow: hidden;
    }

    /* Video Player Styles */
    .video-player-container {
        display: flex;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.95);
        z-index: 3000;
        justify-content: center;
        align-items: center;
    }

    .video-player {
        width: 100%;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .video-player video {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
    }

    .player-controls {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
        padding: 20px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .video-player:hover .player-controls,
    .player-controls.active {
        opacity: 1;
    }

    .control-bar {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .control-btn {
        background: none;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
        padding: 5px;
        transition: all 0.3s ease;
    }

    .control-btn:hover {
        color: #FFD700;
        /* Jaune */
        transform: scale(1.1);
    }

    .progress-container {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .progress-background {
        position: relative;
        width: 100%;
        height: 5px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 5px;
    }

    .progress-filled {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        background: #FFD700;
        /* Ligne jaune */
        border-radius: 5px;
        width: 0%;
        transition: width 0.1s linear;
    }

    .progress-bar {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        -webkit-appearance: none;
        background: transparent;
        border-radius: 5px;
        outline: none;
        cursor: pointer;
        opacity: 0;
        /* Invisible mais cliquable */
    }

    .progress-bar::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 12px;
        height: 12px;
        background: #FFD700;
        border-radius: 50%;
        cursor: pointer;
    }

    .time-display {
        color: white;
        font-size: 14px;
        min-width: 100px;
    }

    .volume-bar {
        width: 80px;
        -webkit-appearance: none;
        height: 5px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 5px;
        outline: none;
        cursor: pointer;
    }

    .volume-bar::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 10px;
        height: 10px;
        background: #FFD700;
        border-radius: 50%;
        cursor: pointer;
    }

    .settings-menu {
        position: absolute;
        bottom: 60px;
        right: 20px;
        background: rgba(0, 0, 0, 0.8);
        padding: 10px;
        border-radius: 5px;
        display: none;
    }

    .settings-menu.active {
        display: block;
    }

    .settings-option {
        margin: 10px 0;
        color: white;
    }

    .settings-option label {
        margin-right: 10px;
    }

    .settings-option select {
        background: #333;
        color: white;
        border: none;
        padding: 5px;
        border-radius: 3px;
        cursor: pointer;
    }
</style>

<body>
    <!-- Video Player Container -->
    <div class="video-player-container" id="videoPlayerContainer">
        <div class="video-player">
            <video id="videoPlayer" preload="auto" poster="https://via.placeholder.com/1200x675">
                <source src="https://assets.mixkit.co/videos/45127/45127-720.mp4" type="video/mp4">
                Votre navigateur ne supporte pas la balise vidéo.
            </video>
            <div class="player-controls" id="playerControls">
                <div class="control-bar">
                    <button class="control-btn rewind" onclick="rewind10s()">
                        <i class="fas fa-backward"></i>
                    </button>
                    <button class="control-btn play-pause" onclick="togglePlayPause()">
                        <i class="fas fa-play"></i>
                    </button>
                    <button class="control-btn forward" onclick="forward10s()">
                        <i class="fas fa-forward"></i>
                    </button>
                    <div class="progress-container">
                        <div class="progress-background">
                            <div class="progress-filled" id="progressFilled"></div>
                            <input type="range" class="progress-bar" id="videoProgress" min="0" max="100" value="0">
                        </div>
                        <span class="time-display">
                            <span id="currentTime">0:00</span> / <span id="duration">0:00</span>
                        </span>
                    </div>
                    <button class="control-btn volume" onclick="toggleMute()">
                        <i class="fas fa-volume-up"></i>
                    </button>
                    <input type="range" class="volume-bar" id="volumeControl" min="0" max="1" step="0.1" value="1">
                    <button class="control-btn pip" onclick="togglePictureInPicture()">
                        <i class="fas fa-window-restore"></i>
                    </button>
                    <button class="control-btn settings" onclick="toggleSettings()">
                        <i class="fas fa-cog"></i>
                    </button>
                    <button class="control-btn fullscreen" onclick="toggleFullscreen()">
                        <i class="fas fa-expand"></i>
                    </button>
                </div>
                <div class="settings-menu" id="settingsMenu">
                    <div class="settings-option">
                        <label>Qualité:</label>
                        <select id="qualitySelect" onchange="changeQuality()">
                            <option value="high">1080p</option>
                            <option value="medium">720p</option>
                            <option value="low">480p</option>
                        </select>
                    </div>
                    <div class="settings-option">
                        <label>Vitesse:</label>
                        <select id="speedSelect" onchange="changeSpeed()">
                            <option value="0.5">0.5x</option>
                            <option value="1" selected>1x</option>
                            <option value="1.5">1.5x</option>
                            <option value="2">2x</option>
                        </select>
                    </div>
                    <div class="settings-option">
                        <label>Sous-titres:</label>
                        <select id="subtitleSelect" onchange="changeSubtitles()">
                            <option value="off">Désactivés</option>
                            <option value="en">Anglais</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const player = document.getElementById('videoPlayer');
            setupPlayerControls(player);
            player.play();
        });

        document.addEventListener('keydown', (event) => {
            if (event.code === 'Space') {
                event.preventDefault();
                togglePlayPause();
            }
        });

        function setupPlayerControls(player) {
            const progress = document.getElementById('videoProgress');
            const progressFilled = document.getElementById('progressFilled');
            const currentTime = document.getElementById('currentTime');
            const duration = document.getElementById('duration');
            const volumeControl = document.getElementById('volumeControl');

            player.onloadedmetadata = () => {
                duration.textContent = formatTime(player.duration);
                progress.max = player.duration;
            };

            player.ontimeupdate = () => {
                progress.value = player.currentTime;
                const percentage = (player.currentTime / player.duration) * 100;
                progressFilled.style.width = `${percentage}%`; // Ligne jaune suit la progression
                currentTime.textContent = formatTime(player.currentTime);
            };

            progress.oninput = () => {
                player.currentTime = progress.value;
            };

            volumeControl.oninput = () => {
                player.volume = volumeControl.value;
                const volumeIcon = document.querySelector('.volume i');
                volumeIcon.classList.toggle('fa-volume-up', player.volume > 0);
                volumeIcon.classList.toggle('fa-volume-mute', player.volume === 0);
            };
        }

        function togglePlayPause() {
            const player = document.getElementById('videoPlayer');
            const playIcon = document.querySelector('.play-pause i');
            if (player.paused) {
                player.play();
                playIcon.classList.remove('fa-play');
                playIcon.classList.add('fa-pause');
            } else {
                player.pause();
                playIcon.classList.remove('fa-pause');
                playIcon.classList.add('fa-play');
            }
        }

        function toggleMute() {
            const player = document.getElementById('videoPlayer');
            const volumeIcon = document.querySelector('.volume i');
            player.muted = !player.muted;
            volumeIcon.classList.toggle('fa-volume-up', !player.muted);
            volumeIcon.classList.toggle('fa-volume-mute', player.muted);
        }

        function toggleFullscreen() {
            const player = document.getElementById('videoPlayer');
            if (!document.fullscreenElement) {
                player.requestFullscreen().catch(err => console.error(`Erreur plein écran : ${err.message}`));
            } else {
                document.exitFullscreen();
            }
        }

        function rewind10s() {
            const player = document.getElementById('videoPlayer');
            player.currentTime = Math.max(0, player.currentTime - 10);
        }

        function forward10s() {
            const player = document.getElementById('videoPlayer');
            player.currentTime = Math.min(player.duration, player.currentTime + 10);
        }

        function togglePictureInPicture() {
            const player = document.getElementById('videoPlayer');
            if (document.pictureInPictureElement) {
                document.exitPictureInPicture();
            } else if (player.requestPictureInPicture) {
                player.requestPictureInPicture().catch(err => console.error(`Erreur PiP : ${err.message}`));
            }
        }

        function toggleSettings() {
            const settingsMenu = document.getElementById('settingsMenu');
            settingsMenu.classList.toggle('active');
        }

        function changeQuality() {
            const quality = document.getElementById('qualitySelect').value;
            const player = document.getElementById('videoPlayer');
            const currentTime = player.currentTime;
            let newSrc = 'https://assets.mixkit.co/videos/45127/45127-720.mp4'; // URL par défaut
            player.src = newSrc;
            player.currentTime = currentTime;
            player.play();
        }

        function changeSpeed() {
            const player = document.getElementById('videoPlayer');
            player.playbackRate = parseFloat(document.getElementById('speedSelect').value);
        }

        function changeSubtitles() {
            const player = document.getElementById('videoPlayer');
            const subtitleSelect = document.getElementById('subtitleSelect').value;
            const track = player.textTracks[0];
            if (subtitleSelect === 'off') {
                track.mode = 'hidden';
            } else {
                track.mode = 'showing';
            }
        }

        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
        }
    </script>
</body>

</html>