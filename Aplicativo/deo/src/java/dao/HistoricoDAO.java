/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package dao;

import gerais.FabricaConexao;
import model.Historico;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

public class HistoricoDAO {
    
    public static ArrayList<Historico> carregarHistorico(int RegistroAcademico, String AnoLetivo, String IdadeEscolar){
        
        String sqlMateria = "SELECT * FROM deo.Materia INNER JOIN deo.Estudante_has_Materia ON Estudante_has_Materia.Estudante_RegistroAcademico = '"+RegistroAcademico+"' WHERE Materia.IdadeEscolarMateria = '"+IdadeEscolar+"' AND Estudante_has_Materia.Materia_idMateria = idMateria AND Estudante_has_Materia.AnoLetivo_EstudanteHasMateria = '"+AnoLetivo+"'";
        ArrayList<Historico> historico = new ArrayList<>();
        
        try(Connection con = FabricaConexao.criaConexao()){
                        
            PreparedStatement trans = con.prepareStatement(sqlMateria);
            //String criptografia = Criptografia.criptografar(SenhaEstudante);
            
            ResultSet tuplas = trans.executeQuery();
            
            while(tuplas.next()){
                int idMateria = tuplas.getInt("idMateria");
                
                double notaTotal = 0;
                String sqlNotas = "SELECT * FROM deo.Prova INNER JOIN deo.Nota ON Nota.Provas_idProvas = idProva WHERE Materia_idMateria = '"+idMateria+"' AND Estudante_RegistroAcademico = '"+RegistroAcademico+"' AND '"+AnoLetivo+"' = year(DataProva)";
                PreparedStatement nota = con.prepareStatement(sqlNotas);
                ResultSet notas = nota.executeQuery();
                while(notas.next()){
                    notaTotal += notas.getDouble("ValorObtido");
                }
                System.out.println("nota total = " + notaTotal);
                
                int faltaTotal = 0;
                String sqlFalta = "SELECT * FROM deo.Ausencia WHERE Estudante_RegistroAcademico = '"+RegistroAcademico+"' AND Materias_idMateria = '"+idMateria+"' AND '"+AnoLetivo+"' = year(DataAusencia)";
                PreparedStatement falta = con.prepareStatement(sqlFalta);
                ResultSet faltas = falta.executeQuery();
                while(faltas.next()){
                    faltaTotal++;
                }
                System.out.println("falta total = " + faltaTotal);
                
                String situacaoEstudante = "";
                System.out.println(RegistroAcademico + " " + idMateria + " " + AnoLetivo);
                String sqlSituacao = "SELECT * FROM deo.Estudante_has_Materia WHERE Estudante_has_Materia.Estudante_RegistroAcademico = '"+RegistroAcademico+"' AND Estudante_has_Materia.Materia_idMateria = '"+idMateria+"' AND AnoLetivo_EstudanteHasMateria = '"+AnoLetivo+"'";
                PreparedStatement situacao = con.prepareStatement(sqlSituacao);
                ResultSet situacoes = situacao.executeQuery();
                while(situacoes.next()){
                    situacaoEstudante = situacoes.getString("VerificacaoAprovacao");
                }

                
                historico.add(new Historico(tuplas.getString("NomeMateria"), situacaoEstudante, AnoLetivo, notaTotal, faltaTotal));
            }            
        }catch(SQLException ex){
            System.err.println("Erro de execução na consulta de usuário");
        }
        return historico;
    }
}
