DELIMITER //
CREATE PROCEDURE addcliente (limite INT)
BEGIN
DECLARE contador INT DEFAULT 0 ;
DECLARE soma INT DEFAULT 0 ;
loop_teste: LOOP
    SET contador = contador + 1;
    INSERT INTO `dbtickets`.`Cliente` (nome_cliente,email,cpf,telefone,senha) values ('fernando', 'fernando@email.com', '12345678910', '3333-3333', '123456');
    IF contador >= limite THEN
        LEAVE loop_teste;
    END IF;
END LOOP loop_teste;
END//
DELIMITER ;

call addcliente(10000);

select * from Cliente limit 0,10000;

