package model;

public class Nota {
    private int idNota;
    private double ValorObtido;
    private int Provas_idProvas;
    private int Estudante_RegistroAcademico;

    public Nota() {
    }

    public Nota(int idNota, double ValorObtido, int Provas_idProvas, int Estudante_RegistroAcademico) {
        this.idNota = idNota;
        this.ValorObtido = ValorObtido;
        this.Provas_idProvas = Provas_idProvas;
        this.Estudante_RegistroAcademico = Estudante_RegistroAcademico;
    }

    public int getIdNota() {
        return idNota;
    }

    public void setIdNota(int idNota) {
        this.idNota = idNota;
    }

    public double getValorObtido() {
        return ValorObtido;
    }

    public void setValorObtido(double ValorObtido) {
        this.ValorObtido = ValorObtido;
    }

    public int getProvas_idProvas() {
        return Provas_idProvas;
    }

    public void setProvas_idProvas(int Provas_idProvas) {
        this.Provas_idProvas = Provas_idProvas;
    }

    public int getEstudante_RegistroAcademico() {
        return Estudante_RegistroAcademico;
    }

    public void setEstudante_RegistroAcademico(int Estudante_RegistroAcademico) {
        this.Estudante_RegistroAcademico = Estudante_RegistroAcademico;
    }

    @Override
    public String toString() {
        return "Nota{" + "idNota=" + idNota + ", ValorObtido=" + ValorObtido + ", Provas_idProvas=" + Provas_idProvas + ", Estudante_RegistroAcademico=" + Estudante_RegistroAcademico + '}';
    }
    
    
}

