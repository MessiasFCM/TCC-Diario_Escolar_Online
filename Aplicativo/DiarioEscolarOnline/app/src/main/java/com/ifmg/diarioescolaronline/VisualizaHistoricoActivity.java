package com.ifmg.diarioescolaronline;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import Modelo.Estudante;
import Modelo.Historico;
import Modelo.Select;

public class VisualizaHistoricoActivity extends AppCompatActivity {

    private ArrayList<Historico> historico = new ArrayList<>();
    private ListView lVisualizacao;
    private listarHistorico adapter;
    private TextView bVoltarTelaHistoricoEscolher;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_visualiza_historico);
        Bundle dado = getIntent().getExtras();
        int RegistroAcademico = dado.getInt("RegistroAcademico");
        String selectTotal = dado.getString("Select");

        lVisualizacao = (ListView) findViewById(R.id.lVisualizacao);
        bVoltarTelaHistoricoEscolher = (TextView)findViewById(R.id.bVoltarTelaHistoricoEscolher);
        bVoltarTelaHistoricoEscolher.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent it = new Intent(VisualizaHistoricoActivity.this, EstudanteSelectHistorico.class);
                it.putExtra("RegistroAcademico", RegistroAcademico);
                startActivity(it);
                finish();
            }
        });

        String txt = null;
        String[] separado = null;
        txt = selectTotal;
        separado = txt.split(" - ");
        String anoLetivo = separado[0];
        String idadeEscolar = separado[1];
        String situacaoEscolarGeral = separado[2];

        requestHistorico(RegistroAcademico,anoLetivo,idadeEscolar);

    }

    private void requestHistorico(int RegistroAcademico, String anoLetivo, String idadeEscolar){
        System.out.println("Inicio");

        String url = GlobalVar.urlServidor+"historico";
        System.out.println("1");
        RequestQueue pilha = Volley.newRequestQueue(this);
        System.out.println("2");
        StringRequest jsonRequest = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            //onResponse é executado assim que o servidor entrega o resultado do processamento
            @Override
            public void onResponse(String response) {
                System.out.println("3");
                //parametro response é o resultado enviado do servidor para o app
                try {
                    System.out.println("4");
                    System.out.println(response);

                    JSONObject resposta = new JSONObject(response);

                    System.out.println("5");
                    //200 é sucesso
                    if (resposta.getInt("cod") == 200) {
                        System.out.println("200 sucesso");
                        JSONArray usuarioJ = resposta.getJSONArray("informacao");

                        for(int i =0; i<usuarioJ.length(); i++){
                            JSONObject obj = usuarioJ.getJSONObject(i);
                            System.out.println("Teste - " + usuarioJ.getJSONObject(i).toString());

                            String nomeMateria = obj.getString("nomeMateria");
                            String situacaoEscolar = obj.getString("situacaoEscolar");
                            String anoLetivo = obj.getString("anoLetivo");
                            double nota = obj.getDouble("nota");
                            int falta = obj.getInt("falta");

                            historico.add(new Historico(nomeMateria,situacaoEscolar,anoLetivo,nota,falta));

                        }
                        exibirHistorico(historico);


                    } else if (resposta.getInt("cod") == 404) {
                        System.out.println("404 erro");
                        Toast.makeText(VisualizaHistoricoActivity.this, "Usuário ou senha inválidos", Toast.LENGTH_SHORT).show();
                    } else {
                        //erro
                        System.out.println("erro");
                        Toast.makeText(VisualizaHistoricoActivity.this, resposta.getString("informacao"), Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException ex) {
                    ex.printStackTrace();
                    System.out.println("erro no formato JSON enviado ao servidor");
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
                Toast.makeText(VisualizaHistoricoActivity.this, "Verifique sua conexão com a internet", Toast.LENGTH_LONG).show();
            }
        }){

            protected Map<String, String> getParams(){
                Map<String, String> parametros = new HashMap<>();
                parametros.put("servico", "carregar");
                parametros.put("RegistroAcademico", RegistroAcademico+"");
                parametros.put("AnoLetivo", anoLetivo+"");
                parametros.put("IdadeEscolar", idadeEscolar+"");

                return parametros;

            }
        };
        pilha.add(jsonRequest);
    }

    private void exibirHistorico(ArrayList<Historico> historico){

        System.out.println(historico);
        adapter = new listarHistorico(getApplicationContext(), historico);
        lVisualizacao.setAdapter(adapter);
    }
}