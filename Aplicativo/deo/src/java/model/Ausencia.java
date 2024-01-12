package model;

import java.time.LocalDateTime;

public class Ausencia {
    private int idAusencia;
    private LocalDateTime DataAusencia;
    private int Etapa_idEtapa;
    private int Estudante_RegistroAcademico;
    private int Materias_idMateria;

    public Ausencia() {
    }

    public Ausencia(int idAusencia, LocalDateTime DataAusencia, int Etapa_idEtapa, int Estudante_RegistroAcademico, int Materias_idMateria) {
        this.idAusencia = idAusencia;
        this.DataAusencia = DataAusencia;
        this.Etapa_idEtapa = Etapa_idEtapa;
        this.Estudante_RegistroAcademico = Estudante_RegistroAcademico;
        this.Materias_idMateria = Materias_idMateria;
    }

    public int getIdAusencia() {
        return idAusencia;
    }

    public void setIdAusencia(int idAusencia) {
        this.idAusencia = idAusencia;
    }

    public LocalDateTime getDataAusencia() {
        return DataAusencia;
    }

    public void setDataAusencia(LocalDateTime DataAusencia) {
        this.DataAusencia = DataAusencia;
    }

    public int getEtapa_idEtapa() {
        return Etapa_idEtapa;
    }

    public void setEtapa_idEtapa(int Etapa_idEtapa) {
        this.Etapa_idEtapa = Etapa_idEtapa;
    }

    public int getEstudante_RegistroAcademico() {
        return Estudante_RegistroAcademico;
    }

    public void setEstudante_RegistroAcademico(int Estudante_RegistroAcademico) {
        this.Estudante_RegistroAcademico = Estudante_RegistroAcademico;
    }

    public int getMaterias_idMateria() {
        return Materias_idMateria;
    }

    public void setMaterias_idMateria(int Materias_idMateria) {
        this.Materias_idMateria = Materias_idMateria;
    }

    @Override
    public String toString() {
        return "Ausencia{" + "idAusencia=" + idAusencia + ", DataAusencia=" + DataAusencia + ", Etapa_idEtapa=" + Etapa_idEtapa + ", Estudante_RegistroAcademico=" + Estudante_RegistroAcademico + ", Materias_idMateria=" + Materias_idMateria + '}';
    }
    
    
}
