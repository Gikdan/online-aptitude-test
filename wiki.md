# Loading Sheets

### /api/v1/loading-sheets
Resourceful routes are index, create, store, show
Fields required are 
```php
[
    'branch_to_id' => 'required',
    'vehicle_id' => 'required',
    'assigned_to_user_id' => 'required',
    'travel_time' => 'required'
]
```

#### /api/v1/loading-sheets/add-package
Fields are 
```php
[
    'packages.*.package_id' => 'required'
]
``