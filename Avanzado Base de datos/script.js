const alumnos = [
{
    nombre: "Juan",
    apellido: "Gomez",
    dni: 47000000,
    anio: 4,
    curso: "A",
    nota: 8,
},

{
    nombre: "Juan",
    apellido: "Perez",
    dni: 47000001,
    anio: 4,
    curso: "A",
    nota: 9,
},

{
    nombre: "Dante",
    apellido: "Maculan",
    dni: 47000002,
    anio: 5,
    curso: "A",
    nota: 10,
},

{
    nombre: "Martin",
    apellido: "Berestovoy",
    dni: 47000003,
    anio: 5,
    curso: "A",
    nota: 1,
},

{
    nombre: "Ramiro",
    apellido: "Levi",
    dni: 47000004,
    anio: 4,
    curso: "B",
    nota: 2,
},

{
    nombre: "Bautista",
    apellido: "Czerniuk",
    dni: 47000005,
    anio: 4,
    curso: "B",
    nota: 3,
},

{
    nombre: "Santino",
    apellido: "Couriel",
    dni: 47000006,
    anio: 3,
    curso: "B",
    nota: 5,
},

{
    nombre: "Zoe",
    apellido: "Perez Colman",
    dni: 47000007,
    anio: 3,
    curso: "B",
    nota: 8,
},
]

//Ejercicio 2
//Crear una función “capitalizar” que recibe un string, hace la primera letra mayúscula y lo devuelve (utilizar la notación “arrow function”).

const capitalizar = (string) => {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

//Ejercicio 3
// Crear una función “mostrarAlumno” que recibe un alumno y muestra su información de la siguiente manera en consola: DNI: 46.345.678
// Nombre y apellido: Juan Gomez
//Curso: 4°A
// Nota: 8

const mostrarAlumno = (alumno) => {
    console.log(`DNI: ${alumno.dni}`);
    console.log(`Nombre y apellido: ${alumno.nombre} ${alumno.apellido}`);
    console.log(`Curso: ${alumno.anio}°${alumno.curso}`);
    console.log(`Nota: ${alumno.nota}`);
}

//Ejercicio 4
//Utilizando la función “capitalizar”, capitalizar el nombre y el apellido de todos los alumnos en el array.

const capitalizarAlumnos = (alumnos) => {
    for (let alumno of alumnos) {
        alumno.nombre = capitalizar(alumno.nombre);
        alumno.apellido = capitalizar(alumno.apellido);
    }
}

//Ejercicio 5
//Utilizando la función “mostrarAlumno”, mostrar todos los alumnos del array.

const mostrarAlumnos = (alumnos) => {
    for (let alumno of alumnos) {
        mostrarAlumno(alumno);
    }
}

//Ejercicio 6
//Mostrar únicamente los alumnos aprobados.
const mostrarAlumnosAprobados = (alumnos) => {
    for (let alumno of alumnos) {
        if (alumno.nota >= 4) {
            mostrarAlumno(alumno);
        }
    }
}
//Mostrar únicamente los alumnos de 4to año.
const mostrarAlumnos4to = (alumnos) => {
    for (let alumno of alumnos) {
        if (alumno.anio == 4) {
            mostrarAlumno(alumno);
        }
    }
}

//Mostrar únicamente los alumnos de curso “B”.

const mostrarAlumnosCursoB = (alumnos) => {
    for (let alumno of alumnos) {
        if (alumno.curso == "B") {
            mostrarAlumno(alumno);
        }
    }
}   

