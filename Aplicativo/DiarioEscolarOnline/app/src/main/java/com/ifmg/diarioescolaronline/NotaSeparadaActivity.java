package com.ifmg.diarioescolaronline;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;

public class NotaSeparadaActivity extends AppCompatActivity {

    private TextView bVoltarTelaNotaSeparada;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_nota_separada);

        bVoltarTelaNotaSeparada = findViewById(R.id.bVoltarTelaNotaSeparada);
        bVoltarTelaNotaSeparada.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }
}