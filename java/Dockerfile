FROM eclipse-temurin:17-jdk
WORKDIR /app

COPY DiagnosisClassifier.java DiagnosisServer.java \
     weka.jar spark-core.jar slf4j-api.jar slf4j-simple.jar javax.servlet-api.jar \
     jetty-server.jar jetty-http.jar jetty-io.jar jetty-util.jar jetty-security.jar jetty-servlet.jar \
     malaria_multiclass_tuned.model malaria.arff ./

RUN javac -cp .:weka.jar:spark-core.jar:slf4j-api.jar:slf4j-simple.jar:javax.servlet-api.jar:jetty-server.jar:jetty-http.jar:jetty-io.jar:jetty-util.jar:jetty-security.jar:jetty-servlet.jar DiagnosisClassifier.java DiagnosisServer.java

CMD ["java", "-cp", ".:weka.jar:spark-core.jar:slf4j-api.jar:slf4j-simple.jar:javax.servlet-api.jar:jetty-server.jar:jetty-http.jar:jetty-io.jar:jetty-util.jar:jetty-security.jar:jetty-servlet.jar", "DiagnosisServer"]

EXPOSE 8080
