/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package gerais;

import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.ObjectMapper;

public class Resposta {
    private int cod;
    private Object informacao;

    public Resposta(int cod, Object informacao) {
        this.cod = cod;
        this.informacao = informacao;
    }

    public int getCod() {
        return cod;
    }

    public Object getInformacao() {
        return informacao;
    }

    public void setCod(int cod) {
        this.cod = cod;
    }

    public void setInformacao(Object informacao) {
        this.informacao = informacao;
    }
    
    public String toString(){
        ObjectMapper mascara = new ObjectMapper();
        
        try{
            return mascara.writeValueAsString(this);
        }catch(JsonProcessingException ex){
            return "{\"cod\":500, \"informacao\":\"erro no JSON\" }";
        }
        
    }
    
}
