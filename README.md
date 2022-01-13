### How to run
To run the server please do
`npm run serve`

You will be able to access the project under `localhost:8000`

### What was my approach
I have installed plain laravel project, as I did not want to install -ui or any front-end frameworks such as vue, react
I have decided that in this occasion I will just use CDN bootstrap. I also went the route of using BLADE and simple
html forms. We are using one and same path, GET to get view, POST to pass form data which will be used to query necessary data.

### Files of interest
`Models/Property.php` will consist of relationships that are necessary to get location and bookings along with the property data.

`Controllers/PropertyController.php` consist of two functions: `index` to display initial list of properties and `show`
which is triggered when we apply search filters.
  
I have done pagination when there is more than 5 properties listed. As the database consist of only 5 entries, you will
not see it front-end wise, hence if you wish to see it you will either have to add more properties to the database or
reduce pagination in `Controller/PropertyController.php`, `index` and `show` functions where you can see `->paginate(5)`.

Not many routes involved, however all are in `routes/web.php`.

The front-end is in `views/search-filter.blade.php`.

### Happy Testing

P.S. Remember to setup .env file - DB connection

