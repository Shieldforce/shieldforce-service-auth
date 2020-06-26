<?php

    function messageErrors( int $code, string $attribute=null)
    {
        $messages =
            [
                //----------------1000
                "1000"       => "Erro de cadastro de :attribute!",
                "1001"       => "Erro de atualização de : attribute!",
                "1002"       => "Erro de exclusão de :attrubute!",
                "1003"       => "Erro ao acessar dados de  :attribute",
                "1004"       => "Mensagem de Erro Padrão!",
                "1005"       => "Mensagem de Erro Padrão!",
                "1006"       => "Mensagem de Erro Padrão!",
                "1007"       => "Mensagem de Erro Padrão!",
                "1008"       => "Mensagem de Erro Padrão!",
                "1009"       => "Mensagem de Erro Padrão!",
                "1010"       => "Mensagem de Erro Padrão!",
                //----------------2000
                "2000"       => "Mensagem de Erro Padrão!",
                "2001"       => "Mensagem de Erro Padrão!",
                "2002"       => "Mensagem de Erro Padrão!",
                "2003"       => "Mensagem de Erro Padrão!",
                "2004"       => "Mensagem de Erro Padrão!",
                "2005"       => "Mensagem de Erro Padrão!",
                "2006"       => "Mensagem de Erro Padrão!",
                "2007"       => "Mensagem de Erro Padrão!",
                "2008"       => "Mensagem de Erro Padrão!",
                "2010"       => "Mensagem de Erro Padrão!",
                //----------------3000
                "3000"       => "Mensagem de Erro Padrão!",
                "3001"       => "Mensagem de Erro Padrão!",
                "3002"       => "Mensagem de Erro Padrão!",
                "3003"       => "Mensagem de Erro Padrão!",
                "3004"       => "Mensagem de Erro Padrão!",
                "3005"       => "Mensagem de Erro Padrão!",
                "3006"       => "Mensagem de Erro Padrão!",
                "3007"       => "Mensagem de Erro Padrão!",
                "3008"       => "Mensagem de Erro Padrão!",
                "3009"       => "Mensagem de Erro Padrão!",
                "3010"       => "Mensagem de Erro Padrão!",
                //----------------4000
                "4000"       => "Atenção as validações dos campos de :attribute!",
                "4001"       => "Item informado não existe",
                "4002"       => "Mensagem de Erro Padrão!",
                "4003"       => "Mensagem de Erro Padrão!",
                "4004"       => "Mensagem de Erro Padrão!",
                "4005"       => "Mensagem de Erro Padrão!",
                "4006"       => "Mensagem de Erro Padrão!",
                "4007"       => "Mensagem de Erro Padrão!",
                "4008"       => "Mensagem de Erro Padrão!",
                "4009"       => "Mensagem de Erro Padrão!",
                "4010"       => "Mensagem de Erro Padrão!",
                //----------------5000
                "5000"       => "Token Inválido",
                "5001"       => "Token Expirado",
                "5002"       => "Token na Lista Negra",
                "5003"       => "Token não existe",
                "5004"       => "Não Autorizado",
                "5005"       => "Mensagem de Erro Padrão!",
                "5006"       => "Mensagem de Erro Padrão!",
                "5007"       => "Mensagem de Erro Padrão!",
                "5008"       => "Mensagem de Erro Padrão!",
                "5010"       => "Mensagem de Erro Padrão!",
            ];
        $message = $attribute ? str_replace(':attribute', $attribute, $messages[$code]) : str_replace(':attribute', "(Informe a Tabela ou Entidade)", $messages[$code]);
        $return =
            [
                "code"       => $code,
                "message"    => $message,
            ];
        return $return;
    }

    function messageSuccess( int $code, string $attribute=null)
    {
        $messages =
            [
                //----------------10000
                "10000"       => "Logado com Sucesso!",
                "10001"       => "Deslogado com Sucesso!!",
                "10002"       => "Dados do retornados!",
                "10003"       => "Mensagem de Sucesso Padrão!",
                "10004"       => "Mensagem de Sucesso Padrão!",
                "10005"       => "Mensagem de Sucesso Padrão!",
                "10006"       => "Mensagem de Sucesso Padrão!",
                "10007"       => "Mensagem de Sucesso Padrão!",
                "10008"       => "Mensagem de Sucesso Padrão!",
                "10009"       => "Mensagem de Sucesso Padrão!",
                "10010"       => "Mensagem de Sucesso Padrão!",
                //----------------20000
                "20000"       => "Cadastro de :attribute realizado com sucesso!",
                "20001"       => "Atualização de :attribute realizado com sucesso!",
                "20002"       => "Exclusão de :attribute realizado com sucesso!",
                "20003"       => "Visualização de :attribute mostrado com sucesso!!",
                "20004"       => "Lista de :attribute mostrada com sucesso!",
                "20005"       => "Mensagem de Sucesso Padrão!",
                "20006"       => "Mensagem de Sucesso Padrão!",
                "20007"       => "Mensagem de Sucesso Padrão!",
                "20008"       => "Mensagem de Sucesso Padrão!",
                "20010"       => "Mensagem de Sucesso Padrão!",
                //----------------30000
                "30000"       => "Mensagem de Sucesso Padrão!",
                "30001"       => "Mensagem de Sucesso Padrão!",
                "30002"       => "Mensagem de Sucesso Padrão!",
                "30003"       => "Mensagem de Sucesso Padrão!",
                "30004"       => "Mensagem de Sucesso Padrão!",
                "30005"       => "Mensagem de Sucesso Padrão!",
                "30006"       => "Mensagem de Sucesso Padrão!",
                "30007"       => "Mensagem de Sucesso Padrão!",
                "30008"       => "Mensagem de Sucesso Padrão!",
                "30009"       => "Mensagem de Sucesso Padrão!",
                "30010"       => "Mensagem de Sucesso Padrão!",
                //----------------40000
                "40000"       => "Mensagem de Sucesso Padrão!",
                "40001"       => "Mensagem de Sucesso Padrão!",
                "40002"       => "Mensagem de Sucesso Padrão!",
                "40003"       => "Mensagem de Sucesso Padrão!",
                "40004"       => "Mensagem de Sucesso Padrão!",
                "40005"       => "Mensagem de Sucesso Padrão!",
                "40006"       => "Mensagem de Sucesso Padrão!",
                "40007"       => "Mensagem de Sucesso Padrão!",
                "40008"       => "Mensagem de Sucesso Padrão!",
                "40009"       => "Mensagem de Sucesso Padrão!",
                "40010"       => "Mensagem de Sucesso Padrão!",
                //----------------50000
                "50000"       => "Mensagem de Sucesso Padrão!",
                "50001"       => "Mensagem de Sucesso Padrão!",
                "50002"       => "Mensagem de Sucesso Padrão!",
                "50003"       => "Mensagem de Sucesso Padrão!",
                "50004"       => "Mensagem de Sucesso Padrão!",
                "50005"       => "Mensagem de Sucesso Padrão!",
                "50006"       => "Mensagem de Sucesso Padrão!",
                "50007"       => "Mensagem de Sucesso Padrão!",
                "50008"       => "Mensagem de Sucesso Padrão!",
                "50010"       => "Mensagem de Sucesso Padrão!",
            ];
        $message = $attribute ? str_replace(':attribute', $attribute, $messages[$code]) : str_replace(':attribute', "(Informe a Tabela ou Entidade)", $messages[$code]);
        $return =
            [
                "code"       => $code,
                "message"    => $message,
            ];
        return $return;
    }
