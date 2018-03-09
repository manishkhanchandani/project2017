CREATE TABLE `fxtable` (                                                                                                        
           `fx_id` int(11) NOT NULL AUTO_INCREMENT,                                                                                      
           `fx_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,                                           
           `deleted` int(1) NOT NULL DEFAULT '0',                                                                                        
           `symbol` varchar(200) DEFAULT NULL,                                                                                           
           `order_type` int(11) DEFAULT NULL COMMENT 'OP_BUY 0, OP_SELL 1, OP_BUYLIMIT 2, OP_SELLLIMIT 3, OP_BUYSTOP 4, OP_SELLSTOP 5',  
           `order_price` varchar(200) DEFAULT NULL,                                                                                      
           `order_sl` varchar(200) DEFAULT NULL,                                                                                         
           `order_tp` varchar(200) DEFAULT NULL,                                                                                         
           `order_comment` varchar(200) DEFAULT NULL,                                                                                    
           `order_magic` int(11) DEFAULT NULL,                                                                                           
           `order_expiration` varchar(200) NOT NULL DEFAULT '0',                                                                         
           `include_accounts` longtext,                                                                                                  
           `exclude_accounts` longtext,                                                                                                  
           PRIMARY KEY (`fx_id`)                                                                                                         
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `fx_history` (                                                                 
              `history_id` int(11) NOT NULL AUTO_INCREMENT,                                             
              `account_number` varchar(200) DEFAULT NULL,                                               
              `ticket` int(11) DEFAULT NULL,                                                            
              `price` double DEFAULT NULL,                                                              
              `tp` double DEFAULT NULL,                                                                 
              `sl` double DEFAULT NULL,                                                                 
              `history_type` varchar(200) DEFAULT NULL,                                                 
              `history_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  
              `symbol` varchar(200) DEFAULT NULL,                                                       
              `order_type` int(11) DEFAULT NULL,                                                        
              PRIMARY KEY (`history_id`)                                                                
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;         