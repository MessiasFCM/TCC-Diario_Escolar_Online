package Modelo;

import android.os.Parcel;
import android.os.Parcelable;

public class Select implements Parcelable {
    private String anoLetivo;
    private String idadeEscolar;
    private String situacaoEscolarGeral;

    public Select() {
    }

    public Select(String anoLetivo, String idadeEscolar, String situacaoEscolarGeral) {
        this.anoLetivo = anoLetivo;
        this.idadeEscolar = idadeEscolar;
        this.situacaoEscolarGeral = situacaoEscolarGeral;
    }

    protected Select(Parcel in) {
        anoLetivo = in.readString();
        idadeEscolar = in.readString();
        situacaoEscolarGeral = in.readString();
    }

    public static final Creator<Select> CREATOR = new Creator<Select>() {
        @Override
        public Select createFromParcel(Parcel in) {
            return new Select(in);
        }

        @Override
        public Select[] newArray(int size) {
            return new Select[size];
        }
    };

    public String getAnoLetivo() {
        return anoLetivo;
    }

    public void setAnoLetivo(String anoLetivo) {
        this.anoLetivo = anoLetivo;
    }

    public String getIdadeEscolar() {
        return idadeEscolar;
    }

    public void setIdadeEscolar(String idadeEscolar) {
        this.idadeEscolar = idadeEscolar;
    }

    public String getSituacaoEscolarGeral() {
        return situacaoEscolarGeral;
    }

    public void setSituacaoEscolarGeral(String situacaoEscolarGeral) {
        this.situacaoEscolarGeral = situacaoEscolarGeral;
    }

    @Override
    public String toString() {
        return anoLetivo + idadeEscolar + situacaoEscolarGeral;
    }

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel parcel, int i) {
        parcel.writeString(anoLetivo);
        parcel.writeString(idadeEscolar);
        parcel.writeString(situacaoEscolarGeral);
    }
}
