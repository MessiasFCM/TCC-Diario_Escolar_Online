/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */
package controler;

import dao.HistoricoDAO;
import gerais.Resposta;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import model.Historico;

@WebServlet(name = "HistoricoServlet", urlPatterns = {"/historico"})
public class HistoricoServlet extends HttpServlet {

    private void carregar(HttpServletRequest request, PrintWriter out){
        String registroAcademico = request.getParameter("RegistroAcademico");
        String anoLetivo = request.getParameter("AnoLetivo");
        String idadeEscolar = request.getParameter("IdadeEscolar");
        
        if(registroAcademico != null && anoLetivo != null && idadeEscolar != null){
            
            try{
                int registroacademico = Integer.parseInt(registroAcademico);
                String anoletivo = anoLetivo;
                String idadeescolar = idadeEscolar;
                
                ArrayList<Historico> temp =  HistoricoDAO.carregarHistorico(registroacademico,anoletivo,idadeescolar);
                out.println(new Resposta(200, temp));
                
            }catch(NumberFormatException ex){
                out.println(new Resposta(403, "O tipo de parametro deve ser numerico"));
            }            
        }
        else{
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
                    case "carregar":{
                        carregar(request, out);
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
