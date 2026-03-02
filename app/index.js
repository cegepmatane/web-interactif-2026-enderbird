const { createServer } = require('http');
const next = require('next');

const dev = process.env.NODE_ENV !== 'production';
const app = next({ dev });
const handle = app.getRequestHandler();

const port = 3000; // obligé car next.js l'aime fort

app.prepare().then(() => {
  createServer((req, res) => {
    // Laisse Next gérer toutes les requêtes
    handle(req, res);
  }).listen(port, (err) => {
    if (err) throw err;
    console.log(`Next.js server lancé sur le port ${port}`);
  });
});