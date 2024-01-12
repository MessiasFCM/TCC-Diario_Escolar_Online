package com.ifmg.diarioescolaronline;

import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import Modelo.Estudante;
import Modelo.Select;

import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Spinner;
import android.widget.Toast;

public class EstudanteSelectHistorico extends AppCompatActivity implements AdapterView.OnItemSelectedListener {

    String[] items = {"Material", "Design", "Components", "Android", "5.0 Lollipop"};
    AutoCompleteTextView autoCompleteTxt;
    ArrayAdapter<String> adapterItems;
    public Select select;
    public ArrayList<String> selectTotal = new ArrayList<>();
    public String[] separado;
    public int total = 0;
    public String anoEscolar = "";
    public String idadeEscolar = "";
    public String situacaoEscolarGeral = "";
    public String text = "";

    TextView bCarregarDados, bVoltarTelaPerfilHistorico;

    private void requestEstudante(int idUsuario) {
        System.out.println("Inicio");

        String url = GlobalVar.urlServidor + "estudante";
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

                        System.out.println("201");
                        JSONObject usuarioJ = resposta.getJSONObject("informacao");
                        System.out.println("Usuario" + usuarioJ.toString());

                        int RegistroAcademico = usuarioJ.getInt("registroAcademico");
                        String VerificacaoEstudante = usuarioJ.getString("verificacaoEstudante");


                        String txt = null;
                        separado = null;
                        txt = VerificacaoEstudante;
                        System.out.println(VerificacaoEstudante.toString()+"");
                        System.out.println(txt.toString()+"");
                        separado = txt.split(" - ");
                        System.out.println("Separado = " + separado.toString());
                        System.out.println("tamanho = " + separado.length);

                        total = 0;
                        for (int cont = 0; cont < separado.length; cont++) {
                            total++;
                            System.out.println("entrou 1");
                        }

                        for (int cont = 0; cont <= total; cont++) {
                            System.out.println("entrou 2");
                            if (cont == 3) {
                                anoEscolar = separado[0];
                                idadeEscolar = separado[1];
                                situacaoEscolarGeral = separado[2];
                                Select sel = new Select(anoEscolar + " - ",  idadeEscolar+ " - ", situacaoEscolarGeral);
                                selectTotal.add(sel.toString());


                            } else if (cont == 6) {
                                anoEscolar = separado[3];
                                idadeEscolar = separado[4];
                                situacaoEscolarGeral = separado[5];
                                Select sel = new Select(anoEscolar + " - ",  idadeEscolar+ " - ", situacaoEscolarGeral);
                                selectTotal.add(sel.toString());

                            } else if (cont == 9) {
                                anoEscolar = separado[6];
                                idadeEscolar = separado[7];
                                situacaoEscolarGeral = separado[8];
                                Select sel = new Select(anoEscolar + " - ",  idadeEscolar+ " - ", situacaoEscolarGeral);
                                selectTotal.add(sel.toString());

                            } else if (cont == 12) {
                                anoEscolar = separado[9];
                                idadeEscolar = separado[10];
                                situacaoEscolarGeral = separado[11];
                                Select sel = new Select(anoEscolar + " - ",  idadeEscolar+ " - ", situacaoEscolarGeral);
                                selectTotal.add(sel.toString());

                            } else if (cont == 15) {
                                anoEscolar = separado[12];
                                idadeEscolar = separado[13];
                                situacaoEscolarGeral = separado[14];
                                Select sel = new Select(anoEscolar + " - ",  idadeEscolar+ " - ", situacaoEscolarGeral);
                                selectTotal.add(sel.toString());
                            } else if (cont == 18) {
                                anoEscolar = separado[15];
                                idadeEscolar = separado[16];
                                situacaoEscolarGeral = separado[17];
                                Select sel = new Select(anoEscolar + " - ",  idadeEscolar+ " - ", situacaoEscolarGeral);
                                selectTotal.add(sel.toString());

                            } else if (cont == 21) {
                                anoEscolar = separado[18];
                                idadeEscolar = separado[19];
                                situacaoEscolarGeral = separado[20];
                                Select sel = new Select(anoEscolar + " - ",  idadeEscolar+ " - ", situacaoEscolarGeral);
                                selectTotal.add(sel.toString());

                            } else if (cont == 24) {
                                anoEscolar = separado[21];
                                idadeEscolar = separado[22];
                                situacaoEscolarGeral = separado[23];
                                Select sel = new Select(anoEscolar + " - ",  idadeEscolar+ " - ", situacaoEscolarGeral);
                                selectTotal.add(sel.toString());
                            } else if (cont == 27) {
                                anoEscolar = separado[24];
                                idadeEscolar = separado[25];
                                situacaoEscolarGeral = separado[26];
                                Select sel = new Select(anoEscolar + " - ",  idadeEscolar+ " - ", situacaoEscolarGeral);
                                selectTotal.add(sel.toString());

                            } else if (cont == 30) {
                                anoEscolar = separado[27];
                                idadeEscolar = separado[28];
                                situacaoEscolarGeral = separado[29];
                                Select sel = new Select(anoEscolar + " - ",  idadeEscolar+ " - ", situacaoEscolarGeral);
                                selectTotal.add(sel.toString());

                            } else if (cont == 33) {
                                anoEscolar = separado[30];
                                idadeEscolar = separado[31];
                                situacaoEscolarGeral = separado[32];
                                Select sel = new Select(anoEscolar + " - ",  idadeEscolar+ " - ", situacaoEscolarGeral);
                                selectTotal.add(sel.toString());

                            } else if (cont == 36) {
                                anoEscolar = separado[33];
                                idadeEscolar = separado[34];
                                situacaoEscolarGeral = separado[35];
                                Select sel = new Select(anoEscolar + " - ",  idadeEscolar+ " - ", situacaoEscolarGeral);
                                selectTotal.add(sel.toString());

                            } else if (cont == 39) {
                                anoEscolar = separado[36];
                                idadeEscolar = separado[37];
                                situacaoEscolarGeral = separado[38];
                                Select sel = new Select(anoEscolar + " - ",  idadeEscolar+ " - ", situacaoEscolarGeral);
                                selectTotal.add(sel.toString());

                            } else if (cont == 42) {
                                anoEscolar = separado[39];
                                idadeEscolar = separado[40];
                                situacaoEscolarGeral = separado[41];
                                Select sel = new Select(anoEscolar + " - ",  idadeEscolar+ " - ", situacaoEscolarGeral);
                                selectTotal.add(sel.toString());

                            } else if (cont == 45) {
                                anoEscolar = separado[42];
                                idadeEscolar = separado[43];
                                situacaoEscolarGeral = separado[44];
                                Select sel = new Select(anoEscolar + " - ",  idadeEscolar+ " - ", situacaoEscolarGeral);
                                selectTotal.add(sel.toString());
                            }
                        }

                        System.out.println("Teste apos =" + VerificacaoEstudante.toString());
                        System.out.println("total = " + total);


                        Estudante estudante = new Estudante(RegistroAcademico, VerificacaoEstudante);

                        System.out.println("Estudantee : " + estudante.toString());

                        criarSelect(selectTotal);


                    } else if (resposta.getInt("cod") == 404) {
                        System.out.println("404 erro");
                        Toast.makeText(EstudanteSelectHistorico.this, "Usuário ou senha inválidos", Toast.LENGTH_SHORT).show();
                    } else {
                        //erro
                        System.out.println("erro");
                        Toast.makeText(EstudanteSelectHistorico.this, resposta.getString("informacao"), Toast.LENGTH_LONG).show();
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
                Toast.makeText(EstudanteSelectHistorico.this, "Verifique sua conexão com a internet", Toast.LENGTH_LONG).show();
            }
        }) {

            protected Map<String, String> getParams() {
                Map<String, String> parametros = new HashMap<>();
                parametros.put("servico", "consulta");
                parametros.put("RegistroAcademico", idUsuario + "");

                return parametros;

            }
        };
        pilha.add(jsonRequest);
    }

    @SuppressLint("WrongViewCast")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        Bundle dado = getIntent().getExtras();
        int idUsuario = dado.getInt("RegistroAcademico");
        requestEstudante(idUsuario);
        System.out.println("Tela Historico"+idUsuario);
        setContentView(R.layout.select_historico);

        bCarregarDados = (TextView)findViewById(R.id.bCarregarDados);
        bCarregarDados.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent it = new Intent(EstudanteSelectHistorico.this, VisualizaHistoricoActivity.class);
                it.putExtra("RegistroAcademico", idUsuario);
                it.putExtra("Select", text);
                startActivity(it);
                finish();
            }
        });
        bVoltarTelaPerfilHistorico = (TextView)findViewById(R.id.bVoltarTelaPerfilHistorico);
        bVoltarTelaPerfilHistorico.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent it = new Intent(EstudanteSelectHistorico.this, PerfilActivity.class);
                it.putExtra("RegistroAcademico", idUsuario);
                startActivity(it);
                finish();
            }
        });

    }

    private void criarSelect(ArrayList select){
        Spinner spinner = findViewById(R.id.spinner1);

        ArrayAdapter<String> adapter = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, select);
        spinner.setAdapter(adapter);

        spinner.setOnItemSelectedListener(this);
    }
    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
        text = parent.getItemAtPosition(position).toString();


    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }
}