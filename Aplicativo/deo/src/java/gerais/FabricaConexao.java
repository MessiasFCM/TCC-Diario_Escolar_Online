package gerais;

import java.sql.Connection;
import java.sql.SQLException;
import javax.naming.Context;
import javax.naming.InitialContext;
import javax.naming.NamingException;
import javax.sql.DataSource;

public class FabricaConexao {
    
    private static Connection con;
    
    public static Connection criaConexao(){

        try{
            
            if(con != null && !con.isClosed()){
                return con;
            }
            
            Context contexto = new InitialContext();
            
            if(contexto == null){
                System.err.println("Erro de configuração no netbeans");
            }
            else{
                Context envContext = (Context) contexto.lookup("java:comp/env");
                DataSource ds = (DataSource) envContext.lookup("jdbc/deo");
                
                if(ds != null){
                    con = ds.getConnection();
                }
            }
            
        }catch(NamingException ex){
            System.err.println("Não existe o dataSource requisitado");
        }catch(SQLException ex){
            System.err.println("erro ao estabelecer conexão com o banco de dados");
        }
        
        return con;
        
    }

}
