<div>
    <h1>febri lemah</h1>

    <div id="lemah-container"></div>

    <script>
        // Play a random sound and add text infinitely
        const sounds = [
            "https://www.soundjay.com/button/sounds/button-3.mp3",
            "https://www.soundjay.com/button/sounds/button-09.mp3",
            "https://www.soundjay.com/button/sounds/button-10.mp3"
        ];
        let i = 0;
        function infiniteLoop() {
            // Add text
            const p = document.createElement('p');
            p.textContent = `LEMAH LU ${i + 1}`;
            document.getElementById('lemah-container').appendChild(p);

            // Play sound
            const audio = new Audio(sounds[Math.floor(Math.random() * sounds.length)]);
            audio.play();

            i++;
            setTimeout(infiniteLoop, 100); // Adjust speed as needed
        }
        infiniteLoop();

        // Animate background and h1 text
        let j = 0;
        function changeBackgroundAndText() {
            document.body.style.background = `hsl(${j % 360}, 70%, 80%)`;
            document.querySelector('h1').textContent = `LEMAH ${j + 1}`;
            j++;
            requestAnimationFrame(changeBackgroundAndText);
        }
        changeBackgroundAndText();
    </script>
</div>