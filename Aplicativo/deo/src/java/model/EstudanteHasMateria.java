package model;

public class EstudanteHasMateria {
    private int Estudante_RegistroAcademico;
    private int Materia_idMateria;
    private int AnoLetivo_EstudanteHasMateria;
    private String VerificacaoAprovacao;

    public EstudanteHasMateria() {
    }

    public EstudanteHasMateria(int Estudante_RegistroAcademico, int Materia_idMateria, int AnoLetivo_EstudanteHasMateria, String VerificacaoAprovacao) {
        this.Estudante_RegistroAcademico = Estudante_RegistroAcademico;
        this.Materia_idMateria = Materia_idMateria;
        this.AnoLetivo_EstudanteHasMateria = AnoLetivo_EstudanteHasMateria;
        this.VerificacaoAprovacao = VerificacaoAprovacao;
    }

    public int getEstudante_RegistroAcademico() {
        return Estudante_RegistroAcademico;
    }

    public void setEstudante_RegistroAcademico(int Estudante_RegistroAcademico) {
        this.Estudante_RegistroAcademico = Estudante_RegistroAcademico;
    }

    public int getMateria_idMateria() {
        return Materia_idMateria;
    }

    public void setMateria_idMateria(int Materia_idMateria) {
        this.Materia_idMateria = Materia_idMateria;
    }

    public int getAnoLetivo_EstudanteHasMateria() {
        return AnoLetivo_EstudanteHasMateria;
    }

    public void setAnoLetivo_EstudanteHasMateria(int AnoLetivo_EstudanteHasMateria) {
        this.AnoLetivo_EstudanteHasMateria = AnoLetivo_EstudanteHasMateria;
    }

    public String getVerificacaoAprovacao() {
        return VerificacaoAprovacao;
    }

    public void setVerificacaoAprovacao(String VerificacaoAprovacao) {
        this.VerificacaoAprovacao = VerificacaoAprovacao;
    }

    @Override
    public String toString() {
        return "EstudanteHasMateria{" + "Estudante_RegistroAcademico=" + Estudante_RegistroAcademico + ", Materia_idMateria=" + Materia_idMateria + ", AnoLetivo_EstudanteHasMateria=" + AnoLetivo_EstudanteHasMateria + ", VerificacaoAprovacao=" + VerificacaoAprovacao + '}';
    }
    
    
}
