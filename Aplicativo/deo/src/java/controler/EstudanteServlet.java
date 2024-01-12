/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */
package controler;

import dao.EstudanteDAO;
import gerais.Resposta;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import model.Estudante;

@WebServlet(name = "EstudanteServlet", urlPatterns = {"/estudante"})
public class EstudanteServlet extends HttpServlet {

    private void login(HttpServletRequest request, PrintWriter out){
        String EmailEstudante = request.getParameter("email");
        String SenhaEstudante = request.getParameter("senha");
//        out.println("Entrou 1");
        if(EmailEstudante == null || SenhaEstudante == null){
            out.println(new Resposta(403, "Para Login é necessário informar email e senha"));
            out.println("Email: "+EmailEstudante);
            out.println("Senha: "+SenhaEstudante);
        }
        else{
//            out.println("Entrou 2");
            Estudante temp =  EstudanteDAO.loginEstudante(EmailEstudante, SenhaEstudante);
//            out.println("Entrou");
            if(temp == null){
                out.println(new Resposta(404, "Usuário não cadastrado ou encontrado"));
            }else{
                out.println(new Resposta(200, temp));
            }
        }
        
    }
    
    private void consultaEstudante(HttpServletRequest request, PrintWriter out){
        String idStr = request.getParameter("RegistroAcademico");
        
        if(idStr != null){
            
            try{
                int id = Integer.parseInt(idStr);
                Estudante temp =  EstudanteDAO.consultarEstudante(id);
                out.println(new Resposta(200, temp));
                
            }catch(NumberFormatException ex){
                out.println(new Resposta(403, "O tipo de parametro deve ser numerico"));
            }            
        }
        else{
            //Uma busca pelo usuario com o id pretendido
        }
    }
    private void atualizaEstudante(HttpServletRequest request, PrintWriter out){
        String idStr = request.getParameter("RegistroAcademico");
        String senha = request.getParameter("SenhaEstudante");
        
        if(idStr != null && senha != null){
            try{
                //Estudante atualizar = new Estudante(Integer.parseInt(idStr), senha);

                if(EstudanteDAO.updateEstudante(Integer.parseInt(idStr), senha)){
                    out.println(new Resposta(200, "Atualizado com sucesso"));
                }
                else{
                    out.println(new Resposta(400, "Problema ao atualizar o usuário"));
                }
            }catch(NumberFormatException ex){
                out.println(new Resposta(403, "O tipo de parâmetro deve ser numerico"));
            }
        }else{
            //Uma busca pelo usuario com o id pretendido
        }
        
    }
    
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            
            String servico = request.getParameter("servico");
            
            if(servico==null){
                //temos que enviar uma mensagem dizendo que o serviço não foi especificado
                out.println("Serviço não especificado");
            }
            else{
                switch(servico){
                    case "login":{
                        login(request, out);
                    }break;
                    case "consulta":{
                        consultaEstudante(request, out);
                    }break;
                    case "atualizacao":{
                        atualizaEstudante(request, out);
                    }break;
                    default:{
                        out.println("Serviço não disponivel para o estudante");
                    }
                }
            }
            
            
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
