package si.uni_lj.fe.seminar.kriptoprice;

import android.content.Intent;
import android.graphics.PorterDuff;
import android.graphics.drawable.Drawable;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.webkit.WebResourceError;
import android.webkit.WebResourceRequest;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

import java.net.URL;

public class ChartActivity extends AppCompatActivity {

    private WebView webView;
    private static final String IP = "192.168.64.100"; //ip streznika
//    private static final String IP = "10.0.2.2"; //localhost od PC za poganjanje iz emulatorja
    private static final String URL = "http://" + IP + "/client_seminar/chart_mobile.php"; //pot do mobilne strani za telefone

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_chart); //nalozi taprav pogled

        webView = (WebView) findViewById(R.id.webviewChart); //povemo kateri webview je izbran za prikaz
        //da se stran odpre znotraj aplikacije + lovljenje napak
        webView.setWebViewClient(new WebViewClient(){
            public void onReceivedError(WebView view, int errorCode, String description, String failingUrl){
                webView.loadUrl("file:///android_asset/error.html"); //preusmeritev ob pojavitvi napake
                Toast.makeText(ChartActivity.this, "Error code is: " + errorCode, Toast.LENGTH_LONG).show();
            }
        });
        webView.loadUrl(URL); //nalozi zeljeno stran

        WebSettings webSettings = webView.getSettings();
        webSettings.setCacheMode(WebSettings.LOAD_NO_CACHE); //ne kesiraj
        webSettings.setJavaScriptEnabled(true); //omogoci izvajanje JS
    }

    @Override
    public void onBackPressed() {
        //gumb nazaj mora iti na prejsnjo stran, ne da izstopi iz aplikacije
        if (webView.canGoBack()) {
            webView.goBack();
        } else {
            super.onBackPressed(); //izstopi iz aplikacije
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu){
        //prikaze meni
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.meni, menu);
        //spremeni trenutno ikono v belo
        Drawable drawable = menu.getItem(0).getIcon();
        drawable.mutate();
        drawable.setColorFilter(getResources().getColor(R.color.white), PorterDuff.Mode.SRC_ATOP);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.table:
                moveToMainActivity(); //premakne na drug activity
                break;
            case R.id.chart:
                webView.loadUrl(URL); //ponovno nalozi trenutno stran
                break;
        }
        return super.onOptionsItemSelected(item);
    }

    public void moveToMainActivity() {
        Intent intent = new Intent(this, MainActivity.class);
        startActivity(intent);
    }
}
