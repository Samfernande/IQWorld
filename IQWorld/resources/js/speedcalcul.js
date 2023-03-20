var monCanvas = document.getElementById('canvasGames')
var ctx = monCanvas.getContext('2d');

// Créer un objet Image
var bg = new Image();
// Définir la source de l'image
bg.src = Storage::url('static/logo.png');
// Attendre que l'image soit chargée
bg.onload = function() {
  // Dessiner l'image sur le canvas
  ctx.drawImage(bg, 0, 0);
};

ctx.font = "60px Arial";
ctx.strokeText("Hello World", monCanvas.width / 2 - 155, monCanvas.width / 2);

console.log(monCanvas.width);