package com.ifmg.diarioescolaronline;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.os.Parcelable;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.gson.JsonParser;

import org.json.JSONException;
import org.json.JSONObject;

import java.math.BigInteger;
import java.sql.SQLOutput;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.LocalTime;
import java.time.format.DateTimeFormatter;
import java.util.HashMap;
import java.util.Map;

import Ferramentas.EstudantesDB;
import Modelo.Estudante;

public class MainActivity extends AppCompatActivity  {

    TextView bLogin, bMainSair;
    EditText eUsuario,eSenha;
    String eUsuarioString, eSenhaString, md5str;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        if(ContextCompat.checkSelfPermission(getBaseContext(), Manifest.permission.INTERNET) != PackageManager.PERMISSION_GRANTED){
            ActivityCompat.requestPermissions(MainActivity.this, new String[] { Manifest.permission.INTERNET}, 0);
        }

        eUsuario = (EditText) findViewById(R.id.usuario);
        eSenha = (EditText)findViewById(R.id.senha);
        bMainSair = (TextView)findViewById(R.id.bMainSair);

        eUsuario.setText(null);
        eSenha.setText(null);

        bLogin = (TextView)findViewById(R.id.login);
        bLogin.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                requestEstudante();
            }
        });

        bMainSair.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View view) {
                finish();
                System.exit(0);
            }
        });

    }

    private void requestEstudante(){
        eUsuario = (EditText) findViewById(R.id.usuario);
        eUsuarioString = eUsuario.getText().toString().trim();
        eSenha = (EditText) findViewById(R.id.senha);
        eSenhaString = eSenha.getText().toString().trim();

        byte[] md5input = eSenha.getText().toString().getBytes();
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



        System.out.println("Inicio");
        System.out.println("Senha Superior: " + md5str);

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
                        Toast.makeText(MainActivity.this, "Busca realizada com sucesso", Toast.LENGTH_LONG).show();

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
                        String VerificacaoEstudante = usuarioJ.getString("verificacaoEstudante");



                        Estudante estudante = new Estudante(RegistroAcademico,NomeEstudante,EmailEstudante,SenhaEstudante,InstituicaoEstudante_IdInstituicao,CPFEstudante,
                                AnoLetivoEstudante,IdadeEscolarEstudante,DataNascimentoEstudante,NaturalidadeEstudante,EstadoNatalEstudante,CEPEstudante,
                                TelefoneEstudante, VerificacaoEstudante);

                        System.out.println("to string: "+estudante.toString());

                        Intent it = new Intent(MainActivity.this, PerfilActivity.class);
                        System.out.println("RegistroAcademico:"+ RegistroAcademico);
                        it.putExtra("RegistroAcademico", RegistroAcademico);
                        startActivity(it);

                    } else if (resposta.getInt("cod") == 404) {
                        System.out.println("404 erro");
                        Toast.makeText(MainActivity.this, "Usuário ou senha inválidos", Toast.LENGTH_SHORT).show();
                    } else {
                        //erro
                        System.out.println("erro");
                        Toast.makeText(MainActivity.this, resposta.getString("informacao"), Toast.LENGTH_LONG).show();
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
                Toast.makeText(MainActivity.this, "Verifique sua conexão com a internet", Toast.LENGTH_LONG).show();
            }
        }){
            protected Map<String, String> getParams(){
                Map<String, String> parametros = new HashMap<>();
                System.out.println("Senha Inferior: " + md5str);
                if(eUsuarioString.contains("@")) {
                    parametros.put("servico", "login");
                    parametros.put("email", eUsuarioString);
                    parametros.put("senha", md5str);
                }else{
                    parametros.put("servico", "login");
                    parametros.put("email", eUsuarioString);
                    parametros.put("senha", md5str);
                }

                return parametros;

            }
        };
        pilha.add(jsonRequest);
    }

}