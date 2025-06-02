<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebaseTestController extends Controller
{
    public function index()
    {
        // Accedemos a Firestore
        $firestore = app('firebase')->createFirestore();
        $database = $firestore->database();

        // Creamos un documento de prueba
        $docRef = $database->collection('test')->document('demo');
        $docRef->set([
            'mensaje' => '¡Conexión exitosa con Firebase desde Laravel!',
            'timestamp' => now()
        ]);

        // Leemos el documento
        $snapshot = $docRef->snapshot();

        // Enviamos los datos a la vista
        return view('firebase-test', [
            'data' => $snapshot->data()
        ]);
    }
}
