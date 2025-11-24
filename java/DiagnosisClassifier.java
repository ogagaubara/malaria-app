import weka.core.Instance;
import weka.core.Instances;
import weka.core.DenseInstance;
import weka.classifiers.Classifier;
import java.io.*;

public class DiagnosisClassifier {

    private static Classifier model;
    private static Instances structure;

    static {
        try {
            // Load ARFF structure once
            BufferedReader reader = new BufferedReader(new FileReader("malaria.arff"));
            structure = new Instances(reader);
            structure.setClassIndex(structure.numAttributes() - 1);

            // Load tuned model once
            model = (Classifier) weka.core.SerializationHelper.read("malaria_multiclass_tuned.model");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    /** 
     * Predict from a CSV string of symptoms ("Yes,No,Yes,...").
     * Returns the predicted class label or "error".
     */
    public static String predict(String csvInput) {
        try {
            String[] values = csvInput.split(",");
            double[] instanceValues = new double[structure.numAttributes()];

            // Map Yes/No to numeric values
            for (int i = 0; i < values.length && i < structure.numAttributes() - 1; i++) {
                instanceValues[i] = values[i].equalsIgnoreCase("Yes") ? 0 : 1;
            }

            Instance instance = new DenseInstance(1.0, instanceValues);
            instance.setDataset(structure);

            double result = model.classifyInstance(instance);
            return structure.classAttribute().value((int) result);

        } catch (Exception e) {
            e.printStackTrace();
            return "error";
        }
    }

    /** Command-line entry point for testing */
    public static void main(String[] args) {
        if (args.length != 1 || !args[0].contains(",")) {
            System.out.println("Error: Expected a single CSV string as input.");
            return;
        }
        String inputLine = args[0];
        String prediction = predict(inputLine);
        System.out.println(prediction);
    }
}
