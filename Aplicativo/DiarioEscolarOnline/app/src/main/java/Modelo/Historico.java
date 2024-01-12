package Modelo;

import android.os.Parcel;
import android.os.Parcelable;

public class Historico implements Parcelable {

    private String nomeMateria;
    private String situacaoEscolar;
    private String anoLetivo;
    private double nota;
    private int falta;


    public Historico(String nomeMateria, String situacaoEscolar, String anoLetivo, double nota, int falta) {
        this.nomeMateria = nomeMateria;
        this.situacaoEscolar = situacaoEscolar;
        this.anoLetivo = anoLetivo;
        this.nota = nota;
        this.falta = falta;
    }

    public Historico() {
    }

    protected Historico(Parcel in) {
        nomeMateria = in.readString();
        situacaoEscolar = in.readString();
        anoLetivo = in.readString();
        nota = in.readDouble();
        falta = in.readInt();
    }

    public static final Creator<Historico> CREATOR = new Creator<Historico>() {
        @Override
        public Historico createFromParcel(Parcel in) {
            return new Historico(in);
        }

        @Override
        public Historico[] newArray(int size) {
            return new Historico[size];
        }
    };

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
        return "Historico{" +
                "nomeMateria='" + nomeMateria + '\'' +
                ", situacaoEscolar='" + situacaoEscolar + '\'' +
                ", anoLetivo='" + anoLetivo + '\'' +
                ", nota=" + nota +
                ", falta=" + falta +
                '}';
    }

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        dest.writeString(nomeMateria);
        dest.writeString(situacaoEscolar);
        dest.writeString(anoLetivo);
        dest.writeDouble(nota);
        dest.writeInt(falta);
    }
}

