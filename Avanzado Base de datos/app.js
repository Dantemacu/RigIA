

const express = require("express");
const app = express();

app.use(express.json());

const alumnos = [
{
    nombre: "Juan",
    apellido: "Gomez",
    id:1,
},

{
    nombre: "Pedro",
    apellido: "Martinez",
    id:2,
},

{
    nombre: "Maria",
    apellido: "Fernandez",
    id:3,

},
]

app.listen(3000, () => {
    console.log("Server runnin on port 3000");
});

app.get("/", (req, res) => {
    res.send("API is running...");
});

app.get("/alumnos", (req, res) => {
    res.json(alumnos);
});

app.post("/alumnos", (req, res) => {
    const nombre = req.body.nombre;
    const apellido = req.body.apellido;
    const id = alumnos.length + 1;

    if(!nombre || !apellido){
        res.status(400).send("Faltan datos");
    }

    alumnos.push({
        id: id,
        nombre: nombre,
        apellido: apellido,
    });
    res.status(201).send("Alumno agregado");
});

app.get("/alumnos/:id", (req, res) => {
    const id = parseInt(req.params.id);
    const alumno = alumnos.find((alumno) => alumno.id == id);

    if(!alumno){
        res.status(404).send("Alumno no encontrado");
    }

    res.json(alumno);
})




