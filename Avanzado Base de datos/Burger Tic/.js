const menu = require('./menu.json');
const express = require('express');
const app = express();
app.use(express.json());
app.listen(3000, () => {
    console.log('Server runnin on port 3000');
});
app.get('/', (req, res) => {
    res.send('API is running...');
});



//Crear un endpoint GET /menu que devuelva el menú completo del restaurante.
app.get('/menu', (req, res) => {
    res.json(menu);
});

//Crear un endpoint GET /menu/:id que devuelva el plato con el id indicado.
app.get('/menu/:id', (req, res) => {
    const id = parseInt(req.params.id);
    const plato = menu.find((plato) => plato.id == id);
    if (!plato) {
        res.status(404).send('Plato no encontrado');
    }
    res.json(plato);
});

//Crear un endpoint GET /combos que devuelva únicamente los combos del menú.
app.get('/combos', (req, res) => {
    const combos = menu.filter((plato) => plato.tipo == 'combo');
    res.json(combos);
});

//Crear un endpoint GET /principales que devuelva únicamente los platos principales del menú.
app.get('/principales', (req, res) => {
    const principales = menu.filter((plato) => plato.tipo == 'principal');
    res.json(principales);
});

//Crear un endpoint GET /postres que devuelva únicamente los postres del menú.
app.get('/postres', (req, res) => {
    const postres = menu.filter((plato) => plato.tipo == 'postre');
    res.json(postres);
});

//Crear un endpoint POST /pedido que reciba un array de id's de platos y devuelva el precio total del pedido. El array de platos debe ser pasado en el cuerpo de la petición.
app.post('/pedido', (req, res) => {
    const pedido = req.body;
    const platos = menu.filter((plato) => pedido.includes(plato.id));
    const total = platos.reduce((acc, plato) => acc + plato.precio, 0);
    res.json({ total: total });
});

//Probar todos los endpoints creados utilizando REST Client.
