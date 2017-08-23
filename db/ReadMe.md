
Model.php

1. Database Type: Mysql
2. Methods
    constructor connect to database
    find_by_sql : accept only one sql query as parameter
usage:    
    class->find_by_sql('SELECT * FROM table');
    
    find_by_id  : accept only two parameters one as table, single array
usage: 
    class->find_by_id('SELECT * FROM table WHERE id= 1');
    
    find_by_fields : accept only two parameters one as table, hash
usage: 
    class->find_by_fields('table_name', 'array('name' => 'abiodun', '&username' => 'iamhabbeboy', 'orderby'=>'desc'))
    
    save_record: accept only two parameters one as table, hash
usage:
    class->save_record('table_name', ['name' => 'habbeboy', ''])    
    
    destroy_record: accept only two parameters one as table, hash
usage:
    class->destroy_record('table_name', array('name' => 'habbeboy'));
     
    update_by_fields: accept only two parameters one as table, hash
usage: 
    class -> update_by_fields('table_name', ['name' => 'abiodun', '->id' => 2, '&age' => 12, '|user' => 'iamhabbeboy']);
    [ -> means 'WHERE', &age means 'AND', | means 'OR'  ] 
    
        
    
