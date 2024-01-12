package com.ifmg.diarioescolaronline;

import android.content.Context;
import android.widget.ArrayAdapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import java.util.ArrayList;

import Modelo.Historico;


public class listarHistorico extends ArrayAdapter<Historico> {

    private Context contextoPai;
    private ArrayList<Historico> historicos;

    private static class ViewHolder{
        private TextView nomeMateria;
        private TextView situacaoEscolar;
        private TextView anoLetivo;
        private TextView nota;
        private TextView falta;

    }

    public listarHistorico (Context contexto, ArrayList<Historico> dados){
        super(contexto, R.layout.activity_nota_geraltestetable, dados);

        this.contextoPai = contexto;
        this.historicos = dados;
    }

    @NonNull
    @Override
    public View getView(int indice, @Nullable View convertView, @NonNull ViewGroup parent) {
        //return super.getView(indice, convertView, parent);

        Historico historico = historicos.get(indice);
        ViewHolder novaView;

        final View resultado;

        //Lista está sendo montada pela 1ª vez
        if(convertView == null){
            novaView = new ViewHolder();

            LayoutInflater inflater = LayoutInflater.from(getContext());
            convertView = inflater.inflate(R.layout.activity_nota_geraltestetable, parent, false);

            novaView.nomeMateria = (TextView) convertView.findViewById(R.id.nomeMateria);
            novaView.situacaoEscolar = (TextView) convertView.findViewById(R.id.situacaoEscolar);
            novaView.anoLetivo = (TextView) convertView.findViewById(R.id.anoEscolar);
            novaView.nota = (TextView) convertView.findViewById(R.id.nota);
            novaView.falta = (TextView) convertView.findViewById(R.id.numeroFaltas);

            resultado = convertView;
            convertView.setTag(novaView);
        }
        //Quando um item é modificado
        else{
            novaView = (ViewHolder)  convertView.getTag();
            resultado = convertView;
        }

        //Setar valores de cada campo
        novaView.nomeMateria.setText((historico.getNomeMateria()));
        novaView.situacaoEscolar.setText(historico.getSituacaoEscolar());
        novaView.anoLetivo.setText(historico.getAnoLetivo()+"");
        novaView.nota.setText(historico.getNota()+"");
        novaView.falta.setText(historico.getFalta()+"");

        return resultado;
    }

}
