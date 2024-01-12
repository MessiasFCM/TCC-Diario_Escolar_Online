package com.ifmg.diarioescolaronline;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
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
import org.w3c.dom.Text;

import java.math.BigInteger;
import java.util.HashMap;
import java.util.Map;

import Ferramentas.EstudantesDB;
import Modelo.Estudante;

public class PerfilActivity extends AppCompatActivity {

    private TextView bHistorico, bSair, bAlterarSenha;
    private TextView tRegistroAcademico, tNomeEstudante, tEmailEstudante, tSenha, tSenhaConfirmar;
    private TextView tCPFEstudante, tDataDeNascimento, tNaturalidade,tEstado, tTelefoneEstudante;
    private String md5str;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_perfil);

        bHistorico = (TextView)findViewById(R.id.tHistorico);
        bSair = (TextView)findViewById(R.id.tSair);
        bAlterarSenha = (TextView)findViewById(R.id.tAlterarSenha);

        tRegistroAcademico = (TextView)findViewById(R.id.tRegistroAcademico);
        tNomeEstudante = (TextView)findViewById(R.id.tNomeEstudante);
        tEmailEstudante = (TextView)findViewById(R.id.tEmailEstudante);
        tCPFEstudante = (TextView)findViewById(R.id.tCPFEstudante);
        tDataDeNascimento = (TextView)findViewById(R.id.tDataDeNascimento);
        tNaturalidade = (TextView)findViewById(R.id.tNaturalidade);
        tEstado = (TextView)findViewById(R.id.tEstado);
        tTelefoneEstudante = (TextView)findViewById(R.id.tTelefoneEstudante);
        tSenha = (TextView)findViewById(R.id.tSenha);
        tSenhaConfirmar = (TextView)findViewById(R.id.tSenhaConfirmar);
        Bundle dado = getIntent().getExtras();
        int idUsuario = dado.getInt("RegistroAcademico");


        requestEstudante(idUsuario);
        System.out.println("Tela Perfil"+idUsuario);

        bHistorico.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View view) {
                Intent it = new Intent(PerfilActivity.this, EstudanteSelectHistorico.class);
                it.putExtra("RegistroAcademico", idUsuario);
                startActivity(it);

            }
        });

        bAlterarSenha.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View view) {
                String senha1 = tSenha.getText().toString().trim();
                String senha2 = tSenhaConfirmar.getText().toString().trim();
                if(!senha1.isEmpty()){
                    if(senha1.equals(senha2)){

                        requestEstudanteUpdate(idUsuario,senha1);

                        tSenha.setText(null);
                        tSenhaConfirmar.setText(null);
                    }else{
                        Toast.makeText(PerfilActivity.this, "Senhas não correspondidas", Toast.LENGTH_SHORT).show();
                    }
                }else{
                    Toast.makeText(PerfilActivity.this, "Preencha o campos obrigatórios", Toast.LENGTH_SHORT).show();
                }
            }

        });

        bSair.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View view) {
                finish();
                System.exit(0);
            }
        });


    }

    private void requestEstudante(int idUsuario){
        System.out.println("Inicio");

        String url = GlobalVar.urlServidor+"estudante";
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
                        Toast.makeText(PerfilActivity.this, "Os dados foram carregados com sucesso", Toast.LENGTH_LONG).show();

                        JSONObject usuarioJ = resposta.getJSONObject("informacao");

                        int RegistroAcademico = usuarioJ.getInt("registroAcademico");
                        String NomeEstudante = usuarioJ.getString("nomeEstudante");
                        String EmailEstudante = usuarioJ.getString("emailEstudante");
                         String SenhaEstudante = usuarioJ.getString("senhaEstudante");
                         int InstituicaoEstudante_IdInstituicao = usuarioJ.getInt("instituicaoEstudante_IdInstituicao");
                         String CPFEstudante = usuarioJ.getString("cpfestudante");
                         String AnoLetivoEstudante = usuarioJ.getString("anoLetivoEstudante");
                         String IdadeEscolarEstudante = usuarioJ.getString("idadeEscolarEstudante");
                         String DataNascimentoEstudante = usuarioJ.getString("dataNascimentoEstudante");
                         String NaturalidadeEstudante = usuarioJ.getString("naturalidadeEstudante");
                         String EstadoNatalEstudante = usuarioJ.getString("estadoNatalEstudante");
                         String CEPEstudante = usuarioJ.getString("cepestudante");
                         String TelefoneEstudante = usuarioJ.getString("telefoneEstudante");


                        Estudante estudante = new Estudante(RegistroAcademico,NomeEstudante,EmailEstudante,SenhaEstudante,InstituicaoEstudante_IdInstituicao,CPFEstudante,
                                AnoLetivoEstudante,IdadeEscolarEstudante,DataNascimentoEstudante,NaturalidadeEstudante,EstadoNatalEstudante,CEPEstudante,
                                TelefoneEstudante);

                        System.out.println("to string: "+estudante.toString());

                        tRegistroAcademico.setText(Integer.toString(estudante.getRegistroAcademico()));
                        tNomeEstudante.setText(estudante.getNomeEstudante());
                        tEmailEstudante.setText(estudante.getEmailEstudante());
                        tCPFEstudante.setText(CPFEstudante);
                        tDataDeNascimento.setText(DataNascimentoEstudante);
                        tNaturalidade.setText(NaturalidadeEstudante);
                        tEstado.setText(EstadoNatalEstudante);
                        tTelefoneEstudante.setText(TelefoneEstudante);



                    } else if (resposta.getInt("cod") == 404) {
                        System.out.println("404 erro");
                        Toast.makeText(PerfilActivity.this, "Usuário ou senha inválidos", Toast.LENGTH_SHORT).show();
                    } else {
                        //erro
                        System.out.println("erro");
                        Toast.makeText(PerfilActivity.this, resposta.getString("informacao"), Toast.LENGTH_LONG).show();
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
                Toast.makeText(PerfilActivity.this, "Verifique sua conexão com a internet", Toast.LENGTH_LONG).show();
            }
        }){

            protected Map<String, String> getParams(){
                Map<String, String> parametros = new HashMap<>();
                parametros.put("servico", "consulta");
                parametros.put("RegistroAcademico", idUsuario+"");

                return parametros;

            }
        };
        pilha.add(jsonRequest);
    }

    private void requestEstudanteUpdate(int idUsuario, String senha){
        System.out.println("Inicio");

        String url = GlobalVar.urlServidor+"estudante";
        System.out.println("1");
        RequestQueue pilha = Volley.newRequestQueue(this);
        System.out.println("2");

        byte[] md5input = senha.toString().getBytes();
        BigInteger md5Data = null;

        try {
            md5Data = new BigInteger(1,CriptografiaMD5.encryptMD5(md5input));
        } catch (Exception e) {
            e.printStackTrace();
        }

        md5str = md5Data.toString(16);
        if(md5str.length() < 32){
            md5str = 0 + md5str;
        }
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
                        Toast.makeText(PerfilActivity.this, "Atualização realizada com sucesso", Toast.LENGTH_LONG).show();

                    } else if (resposta.getInt("cod") == 404) {
                        System.out.println("404 erro");
                        Toast.makeText(PerfilActivity.this, "Usuário ou senha inválidos", Toast.LENGTH_SHORT).show();
                    } else {
                        //erro
                        System.out.println("erro");
                        Toast.makeText(PerfilActivity.this, resposta.getString("informacao"), Toast.LENGTH_LONG).show();
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
                Toast.makeText(PerfilActivity.this, "Verifique sua conexão com a internet", Toast.LENGTH_LONG).show();
            }
        }){

            protected Map<String, String> getParams(){
                Map<String, String> parametros = new HashMap<>();
                parametros.put("servico", "atualizacao");
                parametros.put("RegistroAcademico", idUsuario+"");
                parametros.put("SenhaEstudante", md5str);

                return parametros;

            }
        };
        pilha.add(jsonRequest);
    }

}