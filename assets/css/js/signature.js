const canvas = document.getElementById('signature-pad');
const ctx = canvas.getContext('2d');

let drawing = false;

canvas.addEventListener('mousedown', () => drawing = true);
canvas.addEventListener('mouseup', () => {
    drawing = false;
    ctx.beginPath();
});
canvas.addEventListener('mousemove', draw);

function draw(e) {
    if (!drawing) return;

    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.strokeStyle = 'black';

    ctx.lineTo(e.offsetX, e.offsetY);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(e.offsetX, e.offsetY);
}

function clearPad() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function simpanTandaTangan() {
    const dataURL = canvas.toDataURL();
    document.getElementById('signature').value = dataURL;
    return true;
}
