package Modelo;

import android.os.Parcel;
import android.os.Parcelable;

import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.LocalTime;
import java.time.format.DateTimeFormatter;

public class Estudante implements Parcelable {

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
    private String verificacaoEstudante;

    public Estudante() {
    }

    public Estudante(int registroAcademico, String verificacaoEstudante) {
        RegistroAcademico = registroAcademico;
        this.verificacaoEstudante = verificacaoEstudante;
    }

    public Estudante(int registroAcademico, String nomeEstudante, String emailEstudante, String senhaEstudante, int instituicaoEstudante_IdInstituicao, String CPFEstudante, String anoLetivoEstudante, String idadeEscolarEstudante, String dataNascimentoEstudante, String naturalidadeEstudante, String estadoNatalEstudante, String CEPEstudante, String telefoneEstudante, LocalDateTime dataInicioEstudante, LocalDateTime dataFinalEstudante, String verificacaoEstudante) {
        RegistroAcademico = registroAcademico;
        NomeEstudante = nomeEstudante;
        EmailEstudante = emailEstudante;
        SenhaEstudante = senhaEstudante;
        InstituicaoEstudante_IdInstituicao = instituicaoEstudante_IdInstituicao;
        this.CPFEstudante = CPFEstudante;
        AnoLetivoEstudante = anoLetivoEstudante;
        IdadeEscolarEstudante = idadeEscolarEstudante;
        DataNascimentoEstudante = dataNascimentoEstudante;
        NaturalidadeEstudante = naturalidadeEstudante;
        EstadoNatalEstudante = estadoNatalEstudante;
        this.CEPEstudante = CEPEstudante;
        TelefoneEstudante = telefoneEstudante;
        DataInicioEstudante = dataInicioEstudante;
        DataFinalEstudante = dataFinalEstudante;
        this.verificacaoEstudante = verificacaoEstudante;
    }

    public Estudante(int registroAcademico, String nomeEstudante, String emailEstudante, String senhaEstudante, int instituicaoEstudante_IdInstituicao, String CPFEstudante, String anoLetivoEstudante, String idadeEscolarEstudante, String dataNascimentoEstudante, String naturalidadeEstudante, String estadoNatalEstudante, String CEPEstudante, String telefoneEstudante) {
        RegistroAcademico = registroAcademico;
        NomeEstudante = nomeEstudante;
        EmailEstudante = emailEstudante;
        SenhaEstudante = senhaEstudante;
        InstituicaoEstudante_IdInstituicao = instituicaoEstudante_IdInstituicao;
        this.CPFEstudante = CPFEstudante;
        AnoLetivoEstudante = anoLetivoEstudante;
        IdadeEscolarEstudante = idadeEscolarEstudante;
        DataNascimentoEstudante = dataNascimentoEstudante;
        NaturalidadeEstudante = naturalidadeEstudante;
        EstadoNatalEstudante = estadoNatalEstudante;
        this.CEPEstudante = CEPEstudante;
        TelefoneEstudante = telefoneEstudante;
    }

    public Estudante(int registroAcademico, String nomeEstudante, String emailEstudante, String senhaEstudante, int instituicaoEstudante_IdInstituicao, String CPFEstudante, String anoLetivoEstudante, String idadeEscolarEstudante, String dataNascimentoEstudante, String naturalidadeEstudante, String estadoNatalEstudante, String CEPEstudante, String telefoneEstudante, LocalDateTime dataInicioEstudante, LocalDateTime dataFinalEstudante) {
        RegistroAcademico = registroAcademico;
        NomeEstudante = nomeEstudante;
        EmailEstudante = emailEstudante;
        SenhaEstudante = senhaEstudante;
        InstituicaoEstudante_IdInstituicao = instituicaoEstudante_IdInstituicao;
        this.CPFEstudante = CPFEstudante;
        AnoLetivoEstudante = anoLetivoEstudante;
        IdadeEscolarEstudante = idadeEscolarEstudante;
        DataNascimentoEstudante = dataNascimentoEstudante;
        NaturalidadeEstudante = naturalidadeEstudante;
        EstadoNatalEstudante = estadoNatalEstudante;
        this.CEPEstudante = CEPEstudante;
        TelefoneEstudante = telefoneEstudante;
        DataInicioEstudante = dataInicioEstudante;
        DataFinalEstudante = dataFinalEstudante;
    }

    protected Estudante(Parcel in) {
        RegistroAcademico = in.readInt();
        NomeEstudante = in.readString();
        EmailEstudante = in.readString();
        SenhaEstudante = in.readString();
        InstituicaoEstudante_IdInstituicao = in.readInt();
        CPFEstudante = in.readString();
        AnoLetivoEstudante = in.readString();
        IdadeEscolarEstudante = in.readString();
        DataNascimentoEstudante = in.readString();
        NaturalidadeEstudante = in.readString();
        EstadoNatalEstudante = in.readString();
        CEPEstudante = in.readString();
        TelefoneEstudante = in.readString();
        verificacaoEstudante = in.readString();
    }

    public Estudante(int registroAcademico, String nomeEstudante, String emailEstudante, String senhaEstudante, int instituicaoEstudante_IdInstituicao, String CPFEstudante, String anoLetivoEstudante, String idadeEscolarEstudante, String dataNascimentoEstudante, String naturalidadeEstudante, String estadoNatalEstudante, String CEPEstudante, String telefoneEstudante, String verificacaoEstudante) {
        RegistroAcademico = registroAcademico;
        NomeEstudante = nomeEstudante;
        EmailEstudante = emailEstudante;
        SenhaEstudante = senhaEstudante;
        InstituicaoEstudante_IdInstituicao = instituicaoEstudante_IdInstituicao;
        this.CPFEstudante = CPFEstudante;
        AnoLetivoEstudante = anoLetivoEstudante;
        IdadeEscolarEstudante = idadeEscolarEstudante;
        DataNascimentoEstudante = dataNascimentoEstudante;
        NaturalidadeEstudante = naturalidadeEstudante;
        EstadoNatalEstudante = estadoNatalEstudante;
        this.CEPEstudante = CEPEstudante;
        TelefoneEstudante = telefoneEstudante;
        this.verificacaoEstudante = verificacaoEstudante;
    }

    public static final Creator<Estudante> CREATOR = new Creator<Estudante>() {
        @Override
        public Estudante createFromParcel(Parcel in) {
            return new Estudante(in);
        }

        @Override
        public Estudante[] newArray(int size) {
            return new Estudante[size];
        }
    };

    public int getRegistroAcademico() {
        return RegistroAcademico;
    }

    public void setRegistroAcademico(int registroAcademico) {
        RegistroAcademico = registroAcademico;
    }

    public String getNomeEstudante() {
        return NomeEstudante;
    }

    public void setNomeEstudante(String nomeEstudante) {
        NomeEstudante = nomeEstudante;
    }

    public String getEmailEstudante() {
        return EmailEstudante;
    }

    public void setEmailEstudante(String emailEstudante) {
        EmailEstudante = emailEstudante;
    }

    public String getSenhaEstudante() {
        return SenhaEstudante;
    }

    public void setSenhaEstudante(String senhaEstudante) {
        SenhaEstudante = senhaEstudante;
    }

    public int getInstituicaoEstudante_IdInstituicao() {
        return InstituicaoEstudante_IdInstituicao;
    }

    public void setInstituicaoEstudante_IdInstituicao(int instituicaoEstudante_IdInstituicao) {
        InstituicaoEstudante_IdInstituicao = instituicaoEstudante_IdInstituicao;
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

    public void setAnoLetivoEstudante(String anoLetivoEstudante) {
        AnoLetivoEstudante = anoLetivoEstudante;
    }

    public String getIdadeEscolarEstudante() {
        return IdadeEscolarEstudante;
    }

    public void setIdadeEscolarEstudante(String idadeEscolarEstudante) {
        IdadeEscolarEstudante = idadeEscolarEstudante;
    }

    public String getDataNascimentoEstudante() {
        return DataNascimentoEstudante;
    }

    public void setDataNascimentoEstudante(String dataNascimentoEstudante) {
        DataNascimentoEstudante = dataNascimentoEstudante;
    }

    public String getNaturalidadeEstudante() {
        return NaturalidadeEstudante;
    }

    public void setNaturalidadeEstudante(String naturalidadeEstudante) {
        NaturalidadeEstudante = naturalidadeEstudante;
    }

    public String getEstadoNatalEstudante() {
        return EstadoNatalEstudante;
    }

    public void setEstadoNatalEstudante(String estadoNatalEstudante) {
        EstadoNatalEstudante = estadoNatalEstudante;
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

    public void setTelefoneEstudante(String telefoneEstudante) {
        TelefoneEstudante = telefoneEstudante;
    }

    public LocalDateTime getDataInicioEstudante() {
        return DataInicioEstudante;
    }

    public void setDataInicioEstudante(LocalDateTime dataInicioEstudante) {
        DataInicioEstudante = dataInicioEstudante;
    }

    public LocalDateTime getDataFinalEstudante() {
        return DataFinalEstudante;
    }

    public void setDataFinalEstudante(LocalDateTime dataFinalEstudante) {
        DataFinalEstudante = dataFinalEstudante;
    }

    public String getVerificacaoEstudante() {
        return verificacaoEstudante;
    }

    public void setVerificacaoEstudante(String verificacaoEstudante) {
        this.verificacaoEstudante = verificacaoEstudante;
    }

    @Override
    public String toString() {
        return "Estudante{" +
                "RegistroAcademico=" + RegistroAcademico +
                ", NomeEstudante='" + NomeEstudante + '\'' +
                ", EmailEstudante='" + EmailEstudante + '\'' +
                ", SenhaEstudante='" + SenhaEstudante + '\'' +
                ", InstituicaoEstudante_IdInstituicao=" + InstituicaoEstudante_IdInstituicao +
                ", CPFEstudante='" + CPFEstudante + '\'' +
                ", AnoLetivoEstudante='" + AnoLetivoEstudante + '\'' +
                ", IdadeEscolarEstudante='" + IdadeEscolarEstudante + '\'' +
                ", DataNascimentoEstudante='" + DataNascimentoEstudante + '\'' +
                ", NaturalidadeEstudante='" + NaturalidadeEstudante + '\'' +
                ", EstadoNatalEstudante='" + EstadoNatalEstudante + '\'' +
                ", CEPEstudante='" + CEPEstudante + '\'' +
                ", TelefoneEstudante='" + TelefoneEstudante + '\'' +
                ", DataInicioEstudante=" + DataInicioEstudante +
                ", DataFinalEstudante=" + DataFinalEstudante +
                ", verificacaoEstudante='" + verificacaoEstudante + '\'' +
                '}';
    }

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        dest.writeInt(RegistroAcademico);
        dest.writeString(NomeEstudante);
        dest.writeString(EmailEstudante);
        dest.writeString(SenhaEstudante);
        dest.writeInt(InstituicaoEstudante_IdInstituicao);
        dest.writeString(CPFEstudante);
        dest.writeString(AnoLetivoEstudante);
        dest.writeString(IdadeEscolarEstudante);
        dest.writeString(DataNascimentoEstudante);
        dest.writeString(NaturalidadeEstudante);
        dest.writeString(EstadoNatalEstudante);
        dest.writeString(CEPEstudante);
        dest.writeString(TelefoneEstudante);
        dest.writeString(verificacaoEstudante);
    }
}