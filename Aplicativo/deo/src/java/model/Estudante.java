package model;

import java.time.LocalDateTime;

public class Estudante {
    private int RegistroAcademico;
    private String NomeEstudante;
    private String EmailEstudante;
    private String SenhaEstudante;
    private int InstituicaoEstudante_IdInstituicao;
    private String CPFEstudante;
    private String AnoLetivoEstudante;
    private String IdadeEscolarEstudante;
    private String DataNascimentoEstudante;
    private String NaturalidadeEstudante;
    private String EstadoNatalEstudante;
    private String CEPEstudante;
    private String TelefoneEstudante;
    private LocalDateTime DataInicioEstudante;
    private LocalDateTime DataFinalEstudante;
    private String VerificacaoEstudante;

    public Estudante() {
    }

    public Estudante(int RegistroAcademico, String SenhaEstudante) {
        this.RegistroAcademico = RegistroAcademico;
        this.SenhaEstudante = SenhaEstudante;
    }

    public Estudante(int RegistroAcademico, String NomeEstudante, String EmailEstudante, String SenhaEstudante, int InstituicaoEstudante_IdInstituicao, String AnoLetivoEstudante, String IdadeEscolarEstudante) {
        this.RegistroAcademico = RegistroAcademico;
        this.NomeEstudante = NomeEstudante;
        this.EmailEstudante = EmailEstudante;
        this.SenhaEstudante = SenhaEstudante;
        this.InstituicaoEstudante_IdInstituicao = InstituicaoEstudante_IdInstituicao;
        this.AnoLetivoEstudante = AnoLetivoEstudante;
        this.IdadeEscolarEstudante = IdadeEscolarEstudante;
    }
    

    public Estudante(int RegistroAcademico, String NomeEstudante, String EmailEstudante, String SenhaEstudante, int InstituicaoEstudante_IdInstituicao, String CPFEstudante, String AnoLetivoEstudante, String IdadeEscolarEstudante, String DataNascimentoEstudante, String NaturalidadeEstudante, String EstadoNatalEstudante, String CEPEstudante, String TelefoneEstudante, LocalDateTime DataInicioEstudante, LocalDateTime DataFinalEstudante) {
        this.RegistroAcademico = RegistroAcademico;
        this.NomeEstudante = NomeEstudante;
        this.EmailEstudante = EmailEstudante;
        this.SenhaEstudante = SenhaEstudante;
        this.InstituicaoEstudante_IdInstituicao = InstituicaoEstudante_IdInstituicao;
        this.CPFEstudante = CPFEstudante;
        this.AnoLetivoEstudante = AnoLetivoEstudante;
        this.IdadeEscolarEstudante = IdadeEscolarEstudante;
        this.DataNascimentoEstudante = DataNascimentoEstudante;
        this.NaturalidadeEstudante = NaturalidadeEstudante;
        this.EstadoNatalEstudante = EstadoNatalEstudante;
        this.CEPEstudante = CEPEstudante;
        this.TelefoneEstudante = TelefoneEstudante;
        this.DataInicioEstudante = DataInicioEstudante;
        this.DataFinalEstudante = DataFinalEstudante;
    }

    public Estudante(int RegistroAcademico, String NomeEstudante, String EmailEstudante, String SenhaEstudante, int InstituicaoEstudante_IdInstituicao, String CPFEstudante, String AnoLetivoEstudante, String IdadeEscolarEstudante, String DataNascimentoEstudante, String NaturalidadeEstudante, String EstadoNatalEstudante, String CEPEstudante, String TelefoneEstudante, LocalDateTime DataInicioEstudante, LocalDateTime DataFinalEstudante, String VerificacaoEstudante) {
        this.RegistroAcademico = RegistroAcademico;
        this.NomeEstudante = NomeEstudante;
        this.EmailEstudante = EmailEstudante;
        this.SenhaEstudante = SenhaEstudante;
        this.InstituicaoEstudante_IdInstituicao = InstituicaoEstudante_IdInstituicao;
        this.CPFEstudante = CPFEstudante;
        this.AnoLetivoEstudante = AnoLetivoEstudante;
        this.IdadeEscolarEstudante = IdadeEscolarEstudante;
        this.DataNascimentoEstudante = DataNascimentoEstudante;
        this.NaturalidadeEstudante = NaturalidadeEstudante;
        this.EstadoNatalEstudante = EstadoNatalEstudante;
        this.CEPEstudante = CEPEstudante;
        this.TelefoneEstudante = TelefoneEstudante;
        this.DataInicioEstudante = DataInicioEstudante;
        this.DataFinalEstudante = DataFinalEstudante;
        this.VerificacaoEstudante = VerificacaoEstudante;
    }

    public Estudante(int RegistroAcademico, String NomeEstudante, String EmailEstudante, String SenhaEstudante, int InstituicaoEstudante_IdInstituicao, String CPFEstudante, String AnoLetivoEstudante, String IdadeEscolarEstudante, String DataNascimentoEstudante, String NaturalidadeEstudante, String EstadoNatalEstudante, String CEPEstudante, String TelefoneEstudante, String VerificacaoEstudante) {
        this.RegistroAcademico = RegistroAcademico;
        this.NomeEstudante = NomeEstudante;
        this.EmailEstudante = EmailEstudante;
        this.SenhaEstudante = SenhaEstudante;
        this.InstituicaoEstudante_IdInstituicao = InstituicaoEstudante_IdInstituicao;
        this.CPFEstudante = CPFEstudante;
        this.AnoLetivoEstudante = AnoLetivoEstudante;
        this.IdadeEscolarEstudante = IdadeEscolarEstudante;
        this.DataNascimentoEstudante = DataNascimentoEstudante;
        this.NaturalidadeEstudante = NaturalidadeEstudante;
        this.EstadoNatalEstudante = EstadoNatalEstudante;
        this.CEPEstudante = CEPEstudante;
        this.TelefoneEstudante = TelefoneEstudante;
        this.VerificacaoEstudante = VerificacaoEstudante;
    }
    
    

    public int getRegistroAcademico() {
        return RegistroAcademico;
    }

    public void setRegistroAcademico(int RegistroAcademico) {
        this.RegistroAcademico = RegistroAcademico;
    }

    public String getNomeEstudante() {
        return NomeEstudante;
    }

    public void setNomeEstudante(String NomeEstudante) {
        this.NomeEstudante = NomeEstudante;
    }

    public String getEmailEstudante() {
        return EmailEstudante;
    }

    public void setEmailEstudante(String EmailEstudante) {
        this.EmailEstudante = EmailEstudante;
    }

    public String getSenhaEstudante() {
        return SenhaEstudante;
    }

    public void setSenhaEstudante(String SenhaEstudante) {
        this.SenhaEstudante = SenhaEstudante;
    }

    public int getInstituicaoEstudante_IdInstituicao() {
        return InstituicaoEstudante_IdInstituicao;
    }

    public void setInstituicaoEstudante_IdInstituicao(int InstituicaoEstudante_IdInstituicao) {
        this.InstituicaoEstudante_IdInstituicao = InstituicaoEstudante_IdInstituicao;
    }

    public String getCPFEstudante() {
        return CPFEstudante;
    }

    public void setCPFEstudante(String CPFEstudante) {
        this.CPFEstudante = CPFEstudante;
    }

    public String getAnoLetivoEstudante() {
        return AnoLetivoEstudante;
    }

    public void setAnoLetivoEstudante(String AnoLetivoEstudante) {
        this.AnoLetivoEstudante = AnoLetivoEstudante;
    }

    public String getIdadeEscolarEstudante() {
        return IdadeEscolarEstudante;
    }

    public void setIdadeEscolarEstudante(String IdadeEscolarEstudante) {
        this.IdadeEscolarEstudante = IdadeEscolarEstudante;
    }

    public String getDataNascimentoEstudante() {
        return DataNascimentoEstudante;
    }

    public void setDataNascimentoEstudante(String DataNascimentoEstudante) {
        this.DataNascimentoEstudante = DataNascimentoEstudante;
    }

    public String getNaturalidadeEstudante() {
        return NaturalidadeEstudante;
    }

    public void setNaturalidadeEstudante(String NaturalidadeEstudante) {
        this.NaturalidadeEstudante = NaturalidadeEstudante;
    }

    public String getEstadoNatalEstudante() {
        return EstadoNatalEstudante;
    }

    public void setEstadoNatalEstudante(String EstadoNatalEstudante) {
        this.EstadoNatalEstudante = EstadoNatalEstudante;
    }

    public String getCEPEstudante() {
        return CEPEstudante;
    }

    public void setCEPEstudante(String CEPEstudante) {
        this.CEPEstudante = CEPEstudante;
    }

    public String getTelefoneEstudante() {
        return TelefoneEstudante;
    }

    public void setTelefoneEstudante(String TelefoneEstudante) {
        this.TelefoneEstudante = TelefoneEstudante;
    }

    public LocalDateTime getDataInicioEstudante() {
        return DataInicioEstudante;
    }

    public void setDataInicioEstudante(LocalDateTime DataInicioEstudante) {
        this.DataInicioEstudante = DataInicioEstudante;
    }

    public LocalDateTime getDataFinalEstudante() {
        return DataFinalEstudante;
    }

    public void setDataFinalEstudante(LocalDateTime DataFinalEstudante) {
        this.DataFinalEstudante = DataFinalEstudante;
    }

    public String getVerificacaoEstudante() {
        return VerificacaoEstudante;
    }

    public void setVerificacaoEstudante(String VerificacaoEstudante) {
        this.VerificacaoEstudante = VerificacaoEstudante;
    }

    @Override
    public String toString() {
        return "Estudante{" + "RegistroAcademico=" + RegistroAcademico + ", NomeEstudante=" + NomeEstudante + ", EmailEstudante=" + EmailEstudante + ", SenhaEstudante=" + SenhaEstudante + ", InstituicaoEstudante_IdInstituicao=" + InstituicaoEstudante_IdInstituicao + ", CPFEstudante=" + CPFEstudante + ", AnoLetivoEstudante=" + AnoLetivoEstudante + ", IdadeEscolarEstudante=" + IdadeEscolarEstudante + ", DataNascimentoEstudante=" + DataNascimentoEstudante + ", NaturalidadeEstudante=" + NaturalidadeEstudante + ", EstadoNatalEstudante=" + EstadoNatalEstudante + ", CEPEstudante=" + CEPEstudante + ", TelefoneEstudante=" + TelefoneEstudante + ", DataInicioEstudante=" + DataInicioEstudante + ", DataFinalEstudante=" + DataFinalEstudante + ", VerificacaoEstudante=" + VerificacaoEstudante + '}';
    }


}
