package model;

import java.time.LocalDateTime;

public class Historico {
    private String nomeMateria;
    private String situacaoEscolar;
    private String anoLetivo;
    private double nota;
    private int falta;

    public Historico() {
        
    }

    public Historico(String nomeMateria, String situacaoEscolar, String anoLetivo, double nota, int falta) {
        this.nomeMateria = nomeMateria;
        this.situacaoEscolar = situacaoEscolar;
        this.anoLetivo = anoLetivo;
        this.nota = nota;
        this.falta = falta;
    }

    public String getNomeMateria() {
        return nomeMateria;
    }

    public void setNomeMateria(String nomeMateria) {
        this.nomeMateria = nomeMateria;
    }

    public String getSituacaoEscolar() {
        return situacaoEscolar;
    }

    public void setSituacaoEscolar(String situacaoEscolar) {
        this.situacaoEscolar = situacaoEscolar;
    }

    public String getAnoLetivo() {
        return anoLetivo;
    }

    public void setAnoLetivo(String anoLetivo) {
        this.anoLetivo = anoLetivo;
    }

    public double getNota() {
        return nota;
    }

    public void setNota(double nota) {
        this.nota = nota;
    }

    public int getFalta() {
        return falta;
    }

    public void setFalta(int falta) {
        this.falta = falta;
    }

    @Override
    public String toString() {
        return "Historico{" + "nomeMateria=" + nomeMateria + ", situacaoEscolar=" + situacaoEscolar + ", anoLetivo=" + anoLetivo + ", nota=" + nota + ", falta=" + falta + '}';
    }
    
    

}
