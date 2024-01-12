/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package dao;

import gerais.FabricaConexao;
import model.Estudante;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class AusenciaDAO {
    
    public static Estudante loginEstudante(String EmailEstudante, String SenhaEstudante){
        
        String sql = "SELECT * FROM deo.Estudante WHERE EmailEstudante='"+EmailEstudante+"' AND SenhaEstudante='"+SenhaEstudante+"'";
        
//        for(int i=0; i<50; i++){
//            System.out.println("SQL: "+sql);
//        }
        
        
        Estudante temp = null;
        
        try(Connection con = FabricaConexao.criaConexao()){
                        
            PreparedStatement trans = con.prepareStatement(sql);
            //String criptografia = Criptografia.criptografar(SenhaEstudante);
            
            ResultSet tuplas = trans.executeQuery();
            
            while(tuplas.next()){
                //temp = new Estudante(tuplas.getInt("RegistroAcademico"), tuplas.getString("NomeEstudante"), tuplas.getString("EmailEstudante"), tuplas.getString("SenhaEstudante"), tuplas.getInt("InstituicaoEstudante_IdInstituicao"), tuplas.getString("CPFEstudante"), tuplas.getString("AnoLetivoEstudante"), tuplas.getString("IdadeEscolarEstudante"), tuplas.getString("DataNascimentoEstudante"), tuplas.getString("NaturalidadeEstudante"), tuplas.getString("EstadoNatalEstudante"), tuplas.getString("CEPEstudante"), tuplas.getString("TelefoneEstudante"), tuplas.getTimestamp("DataInicioEstudante").toLocalDateTime(), tuplas.getTimestamp("DataFinalEstudante").toLocalDateTime());
                temp = new Estudante(tuplas.getInt("RegistroAcademico"), tuplas.getString("NomeEstudante"), tuplas.getString("EmailEstudante"), tuplas.getString("SenhaEstudante"), tuplas.getInt("InstituicaoEstudante_IdInstituicao"), tuplas.getString("AnoLetivoEstudante"), tuplas.getString("IdadeEscolarEstudante"));
                System.out.println(temp.toString());
            }            
        }catch(SQLException ex){
            System.err.println("Erro de execução na consulta de usuário");
        }
        return temp;
    }
    
    public static Estudante consultarEstudante(int RegistroAcademico){
        String sql = "SELECT * FROM Estudante WHERE RegistroAcademico = '"+RegistroAcademico+"'";
        
        Estudante temp = null;
        
        try(Connection con = FabricaConexao.criaConexao()){
                        
            PreparedStatement trans = con.prepareStatement(sql);
            
            ResultSet tuplas = trans.executeQuery();
            
            while(tuplas.next()){
                temp = new Estudante(tuplas.getInt("RegistroAcademico"), tuplas.getString("NomeEstudante"), tuplas.getString("EmailEstudante"), tuplas.getString("SenhaEstudante"), tuplas.getInt("InstituicaoEstudante_IdInstituicao"), tuplas.getString("CPFEstudante"), tuplas.getString("AnoLetivoEstudante"), tuplas.getString("IdadeEscolarEstudante"), tuplas.getString("DataNascimentoEstudante"), tuplas.getString("NaturalidadeEstudante"), tuplas.getString("EstadoNatalEstudante"), tuplas.getString("CEPEstudante"), tuplas.getString("TelefoneEstudante"), null, null);
            }            
        }catch(SQLException ex){
            System.err.println("Erro de execução na consulta de usuário");
        }
        return temp; 
    }
    
    public static boolean updateEstudante(int RegistroAcademico, String senha){
        
        String sql ="UPDATE Estudante SET SenhaEstudante = '"+senha+"' WHERE RegistroAcademico = '"+RegistroAcademico+"'";
        
        try(Connection con = FabricaConexao.criaConexao()){
            
            PreparedStatement trans = con.prepareStatement(sql);
            
            trans.executeUpdate();
            return true;
            
        }catch(SQLException ex){
            System.err.println("Erro an atualização do usuario");
            return false;
        }
        
        
        
    }
    
}
