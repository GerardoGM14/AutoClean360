<?php

use Kreait\Firebase\Factory;

return (new Factory)
    ->withServiceAccount(base_path('firebase/firebase_credentials.json'));
