
// om van een specifiek event de informatie aan variabelen toe te wijzen is dit de sql query

SELECT @event_name := name, @event_date := date, @event_url := url, @event_location := location, 
@desc := description FROM events WHERE eventid = '@eventid';

