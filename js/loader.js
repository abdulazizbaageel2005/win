// تحميل بسيط، ثم إظهار الاسم والاحتفال. يعمل بدون إنترنت.
const win = document.querySelector('#winner');
const loader = document.querySelector('.loader-con');
const canvas = document.getElementById('circularLoader');
const ctx = canvas.getContext('2d');
const modalElement = document.getElementById('modal');
const myModal = new bootstrap.Modal(modalElement);
const confetti = document.getElementById('confetti');
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
let sim;
let cleanup;

function drawProgress(percent) {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.lineWidth = 12;
    ctx.strokeStyle = '#ffffff25';
    ctx.beginPath();
    ctx.arc(100, 100, 75, 0, Math.PI * 2);
    ctx.stroke();
    ctx.strokeStyle = '#ffb327';
    ctx.lineCap = 'round';
    ctx.beginPath();
    ctx.arc(100, 100, 75, -Math.PI / 2, (percent / 100) * Math.PI * 2 - Math.PI / 2);
    ctx.stroke();
    ctx.fillStyle = '#ffffff';
    ctx.textAlign = 'center';
    ctx.font = 'bold 28px sans-serif';
    ctx.fillText(percent + '%', 100, 110);
}

function celebrate() {
    clearTimeout(cleanup);
    confetti.replaceChildren();
    if (reducedMotion.matches || !modalElement.querySelector('.winner-name')) return;
    const colors = ['#ffb327', '#f33356', '#ff791e', '#8f5bea', '#30bca7'];
    for (let i = 0; i < 70; i++) {
        const piece = document.createElement('span');
        piece.className = 'confetti-piece';
        piece.style.left = Math.random() * 100 + '%';
        piece.style.backgroundColor = colors[i % colors.length];
        piece.style.animationDelay = Math.random() * 0.5 + 's';
        piece.style.animationDuration = 2.3 + Math.random() * 1.2 + 's';
        piece.style.setProperty('--drift', (Math.random() - 0.5) * 180 + 'px');
        confetti.appendChild(piece);
    }
    cleanup = setTimeout(() => confetti.replaceChildren(), 4200);
}

win.addEventListener('click', function () {
    if (win.disabled) return;
    win.disabled = true;
    let percent = 0;
    clearInterval(sim);
    loader.style.display = 'block';
    drawProgress(percent);
    sim = setInterval(function () {
        percent += 1;
        drawProgress(percent);
        if (percent >= 100) {
            clearInterval(sim);
            loader.style.display = 'none';
            myModal.show();
        }
    }, 20);
});
modalElement.addEventListener('shown.bs.modal', celebrate);
modalElement.addEventListener('hidden.bs.modal', function () {
    clearTimeout(cleanup);
    confetti.replaceChildren();
    win.disabled = false;
});
