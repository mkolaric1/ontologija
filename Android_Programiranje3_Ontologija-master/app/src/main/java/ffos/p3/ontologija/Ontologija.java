package ffos.p3.ontologija;

import java.io.Serializable;

public class Ontologija implements Serializable {

    public Ontologija() {
        this.sifra = sifra;
        this.nazivPodcasta = nazivPodcasta;
        this.voditelj = voditelj;
        this.brojPregleda = brojPregleda;
        this.podcastTrajanje = podcastTrajanje;
        this.uriPodcasta = uriPodcasta;
    }

    private int sifra;
    private String nazivPodcasta;
    private String voditelj;
    private Integer brojPregleda;
    private String podcastTrajanje;
    private String uriPodcasta;

    public int getSifra() {
        return sifra;
    }

    public void setSifra(int sifra) {
        this.sifra = sifra;
    }

    public String getNazivPodcasta() {
        return nazivPodcasta;
    }

    public void setNazivPodcasta(String nazivPodcasta) {
        this.nazivPodcasta = nazivPodcasta;
    }

    public String getVoditelj() {
        return voditelj;
    }

    public void setVoditelj(String voditelj) {
        this.voditelj = voditelj;
    }

    public Integer getBrojPregleda() {
        return brojPregleda;
    }

    public void setBrojPregleda(Integer brojPregleda) {
        this.brojPregleda = brojPregleda;
    }

    public String getPodcastTrajanje() {
        return podcastTrajanje;
    }

    public void setPodcastTrajanje(String podcastTrajanje) {
        this.podcastTrajanje = podcastTrajanje;
    }

    public String getUriPodcasta() {
        return uriPodcasta;
    }

    public void setUriPodcasta(String uriPodcasta) {
        this.uriPodcasta = uriPodcasta;
    }
}
