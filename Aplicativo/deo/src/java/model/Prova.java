package model;

import java.time.LocalDateTime;

public class Prova {
    private int idProva;
    private String NomeProva;
    private double ValorProva;
    private LocalDateTime DataProva;
    private int Etapa_idEtapa;
    private int Materia_idMateria;

    public Prova() {
    }

    public Prova(int idProva, String NomeProva, double ValorProva, LocalDateTime DataProva, int Etapa_idEtapa, int Materia_idMateria) {
        this.idProva = idProva;
        this.NomeProva = NomeProva;
        this.ValorProva = ValorProva;
        this.DataProva = DataProva;
        this.Etapa_idEtapa = Etapa_idEtapa;
        this.Materia_idMateria = Materia_idMateria;
    }

    public int getIdProva() {
        return idProva;
    }

    public void setIdProva(int idProva) {
        this.idProva = idProva;
    }

    public String getNomeProva() {
        return NomeProva;
    }

    public void setNomeProva(String NomeProva) {
        this.NomeProva = NomeProva;
    }

    public double getValorProva() {
        return ValorProva;
    }

    public void setValorProva(double ValorProva) {
        this.ValorProva = ValorProva;
    }

    public LocalDateTime getDataProva() {
        return DataProva;
    }

    public void setDataProva(LocalDateTime DataProva) {
        this.DataProva = DataProva;
    }

    public int getEtapa_idEtapa() {
        return Etapa_idEtapa;
    }

    public void setEtapa_idEtapa(int Etapa_idEtapa) {
        this.Etapa_idEtapa = Etapa_idEtapa;
    }

    public int getMateria_idMateria() {
        return Materia_idMateria;
    }

    public void setMateria_idMateria(int Materia_idMateria) {
        this.Materia_idMateria = Materia_idMateria;
    }

    @Override
    public String toString() {
        return "Prova{" + "idProva=" + idProva + ", NomeProva=" + NomeProva + ", ValorProva=" + ValorProva + ", DataProva=" + DataProva + ", Etapa_idEtapa=" + Etapa_idEtapa + ", Materia_idMateria=" + Materia_idMateria + '}';
    }
    
    
}
