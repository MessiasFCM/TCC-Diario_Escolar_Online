package model;

public class Materia {
    private int idMateria; 
    private String NomeMateria;
    private String IdadeEscolarMateria;
    private int Professor_idProfessor;

    public Materia() {
    }

    public Materia(int idMateria, String NomeMateria, String IdadeEscolarMateria, int Professor_idProfessor) {
        this.idMateria = idMateria;
        this.NomeMateria = NomeMateria;
        this.IdadeEscolarMateria = IdadeEscolarMateria;
        this.Professor_idProfessor = Professor_idProfessor;
    }

    public int getIdMateria() {
        return idMateria;
    }

    public void setIdMateria(int idMateria) {
        this.idMateria = idMateria;
    }

    public String getNomeMateria() {
        return NomeMateria;
    }

    public void setNomeMateria(String NomeMateria) {
        this.NomeMateria = NomeMateria;
    }

    public String getIdadeEscolarMateria() {
        return IdadeEscolarMateria;
    }

    public void setIdadeEscolarMateria(String IdadeEscolarMateria) {
        this.IdadeEscolarMateria = IdadeEscolarMateria;
    }

    public int getProfessor_idProfessor() {
        return Professor_idProfessor;
    }

    public void setProfessor_idProfessor(int Professor_idProfessor) {
        this.Professor_idProfessor = Professor_idProfessor;
    }

    @Override
    public String toString() {
        return "Materia{" + "idMateria=" + idMateria + ", NomeMateria=" + NomeMateria + ", IdadeEscolarMateria=" + IdadeEscolarMateria + ", Professor_idProfessor=" + Professor_idProfessor + '}';
    }
    
    
    
}
