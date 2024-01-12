package Ferramentas;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteException;
import android.database.sqlite.SQLiteOpenHelper;
import java.time.LocalDateTime;

import android.widget.Toast;


import com.ifmg.diarioescolaronline.MainActivity;

import Modelo.Estudante;

public class EstudantesDB extends SQLiteOpenHelper {

    private Context contexto;

    public EstudantesDB(Context cont){
        super(cont, "Estudante",  null,  1);
        this.contexto=cont;
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        final String criaTabelaEstudante = "CREATE TABLE IF NOT EXISTS Estudante(RegistroAcademico INTEGER  PRIMARY KEY AUTOINCREMENT , NomeEstudante TEXT,"+
                "EmailEstudante TEXT, SenhaEstudante TEXT)";
        db.execSQL(criaTabelaEstudante);
    }

    public void deletarTabelaEstudante(SQLiteDatabase db) {
        String deletarTabelaEstudante = "DROP TABLE Estudante";
        db.execSQL(deletarTabelaEstudante);
    }

    public void inserirEstudante(Estudante novoEstudante ){

        try (SQLiteDatabase db = this.getWritableDatabase()){

            ContentValues valores = new ContentValues();

            valores.put("NomeEstudante",novoEstudante.getNomeEstudante());
            valores.put("EmailEstudante",novoEstudante.getEmailEstudante());
            valores.put("SenhaEstudante",novoEstudante.getSenhaEstudante());

            System.out.println("Nome: " + valores.get("NomeEstudante"));

            db.insert("Estudante", null, valores);

        }catch (SQLiteException ex){
            ex.printStackTrace();
        }
    }

    public void atualizarEstudante(Estudante novoEstudante){
        try(SQLiteDatabase db = this.getWritableDatabase()){

            ContentValues valores = new ContentValues();
            valores.put("NomeEstudante", novoEstudante.getNomeEstudante());
            valores.put("EmailEstudante", novoEstudante.getEmailEstudante());
            valores.put("SenhaEstudante",novoEstudante.getSenhaEstudante());


            db.update("Estudante", valores, "RegistroAcademico = ?", new String []{novoEstudante.getRegistroAcademico() + ""});

        }catch (SQLiteException ex){
            System.err.println("Erro na atualização");
            ex.printStackTrace();
        }
    }

    public Estudante buscarEstudante(String login){
        String sql = null;
        if (login.contains("@")){
            sql = "SELECT * FROM Estudante WHERE EmailEstudante = '"+login+"'";
        }else{
            sql = "SELECT * FROM Estudante WHERE RegistroAcademico = '"+login+"'";
        }

        Estudante estudante=null;

        try(SQLiteDatabase db = this.getReadableDatabase()) {
            Cursor tuplas = db.rawQuery(sql, null);
            if(tuplas.moveToFirst()){

                int RegistroAcademico = tuplas.getInt(0);
                String NomeEstudante = tuplas.getString(1);
                String EmailEstudante = tuplas.getString(2);
                String SenhaEstudante = tuplas.getString(3);
                int InstituicaoEstudante_IdInstituicao = tuplas.getInt(4);
                String CPFEstudante = tuplas.getString(5);
                String AnoLetivoEstudante = tuplas.getString(6);
                String IdadeEscolarEstudante = tuplas.getString(7);
                String DataNascimentoEstudante = tuplas.getString(8);
                String NaturalidadeEstudante = tuplas.getString(9);
                String EstadoNatalEstudante = tuplas.getString(10);
                String CEPEstudante = tuplas.getString(11);
                String TelefoneEstudante = tuplas.getString(12);

                estudante = new Estudante(RegistroAcademico, NomeEstudante, EmailEstudante, SenhaEstudante, InstituicaoEstudante_IdInstituicao, CPFEstudante, AnoLetivoEstudante, IdadeEscolarEstudante, DataNascimentoEstudante, NaturalidadeEstudante, EstadoNatalEstudante, CEPEstudante, TelefoneEstudante);
            }

        }catch(Exception ex) {
            ex.printStackTrace();
        }
        return estudante;
    }
//
//    public Estudante buscarEstudanteEmail(String login){
//        String sql = "SELECT * FROM Estudante WHERE EmailEstudante = '"+login+"'";
//
//        Estudante estudante=null;
//
//        try(SQLiteDatabase db = this.getReadableDatabase()) {
//            Cursor tuplas = db.rawQuery(sql, null);
//            if(tuplas.moveToFirst()){
//
//                int RegistroAcademico = tuplas.getInt(0);
//                String NomeEstudante = tuplas.getString(1);
//                String EmailEstudante = tuplas.getString(2);
//                String SenhaEstudante = tuplas.getString(3);
//
//                estudante = new Estudante(RegistroAcademico,NomeEstudante,EmailEstudante,SenhaEstudante);
//            }
//
//        }catch(Exception ex) {
//            ex.printStackTrace();
//        }
//        return estudante;
//    }

    @Override
    public void onUpgrade(SQLiteDatabase sqLiteDatabase, int i, int i1) {

    }
}
