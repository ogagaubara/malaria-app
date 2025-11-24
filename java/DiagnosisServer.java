import static spark.Spark.*;

public class DiagnosisServer {
    public static void main(String[] args) {
        // Run on port 8080 (matches Dockerfile and docker-compose)
        port(8080);

        // Simple health check
        get("/health", (req, res) -> {
            res.type("text/plain");
            return "OK";
        });

        // Diagnosis endpoint
        post("/diagnose", (req, res) -> {
            String inputLine = req.body(); // CSV symptoms from PHP
            String result;

            try {
                // Call your existing classifier logic
                result = DiagnosisClassifier.predict(inputLine);
            } catch (Exception e) {
                e.printStackTrace();
                result = "error";
            }

            res.type("text/plain");
            return result;
        });
    }
}
