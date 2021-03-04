<?php
require 'vendor/autoload.php';



# [START fs_initialize]


/**
 * Initialize Cloud Firestore with default project ID.
 * ```
 * initialize();
 * ```
 */


// Imports the Cloud Storage client library.
use Google\Cloud\Storage\StorageClient;

function auth_cloud_explicit($projectId, $serviceAccountPath)
{
    # Explicitly use service account credentials by specifying the private key
    # file.
    $config = [
        'keyFilePath' => './key',
        'projectId' => 'contact-stored',
    ];
    $storage = new StorageClient($config);

    # Make an authenticated API request (listing storage buckets)
    foreach ($storage->buckets() as $bucket) {
        printf('Bucket: %s' . PHP_EOL, $bucket->name());
    }
}

use Google\Cloud\Firestore\FirestoreClient;

$path = './key.json';
function initialize()
{



    function auth_cloud_implicit($projectId)
    {
        $config = [
            'keyFilePath' => $GLOBALS['path'],
            'projectId' => $projectId,
        ];

        # If you don't specify credentials when constructing the client, the
        # client library will look for credentials in the environment.
        $storage = new StorageClient($config);

        # Make an authenticated API request (listing storage buckets)
        foreach ($storage->buckets() as $bucket) {
            printf('Bucket: %s' . PHP_EOL, $bucket->name());
        }
    }

    $projectId = 'contact-stored';
    // Create the Cloud Firestore client
    $db = new FirestoreClient([
        'projectId' => $projectId,
        'keyFilePath' => $GLOBALS['path'],
    ]);
    # [START fs_add_data_1]
    $docRef = $db->collection('users')->document('lovelace');
    $docRef->set([
        'first' => 'Ada',
        'last' => 'Lovelace',
        'born' => 1815
    ]);
    printf('Added data to the lovelace document in the users collection.' . PHP_EOL);
    # [END fs_add_data_1]
    # [START fs_add_data_2]
    $docRef = $db->collection('users')->document('aturing');
    $docRef->set([
        'first' => 'Alan',
        'middle' => 'Mathison',
        'last' => 'Turing',
        'born' => 1912
    ]);
}
initialize();
echo "Successful!";

#<?php header("Location: /event_manager/user/reg.php");
